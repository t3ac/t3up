<?php
declare(strict_types=1);

namespace T3ac\T3up\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Run a sequence of t3up helper commands to assist updating to TYPO3 v13.
 *
 * Context: forwards --force and/or --dry-run to most subcommands with specific exclusions.
 * Only minimal behavior is documented here; command-specific behavior belongs into each subcommand.
 */
final class UpdateTo13Command extends Command
{
    protected static $defaultName = 't3up:update:to13';
    protected static $defaultDescription = 'Run helper commands to update project to TYPO3 v13.';

    /** Ordered list of core commands to execute (key = command name). */
    private const COMMANDS = [
        't3up:symlink:fonts' => [],
        't3up:set:owner-perms' => [],
        // 't3up:update:constants' => [],
        't3up:update:spacing' => [],
        't3up:convert:listtypes' => [],
        't3up:convert:layouts' => [],
        't3up:fix:filetype' => [],
        't3up:fix:grid2' => [],
    ];

    /**
     * Optional commands keyed by extension key.
     * If the extension is loaded, the corresponding command will be appended.
     */
    private const OPTIONAL_COMMANDS = [
        'hda_personen' => [
            'hdapersonen:copy:previousnext',
            'hdapersonen:update:plugin',
        ],
    ];

    /** Commands that must NOT receive --force. */
    private const NO_FORCE_FOR = [
        't3up:symlink:fonts',
        't3up:update:spacing',
        't3up:convert:listtypes',
        'hdapersonen:copy:previousnext',
        't3up:convert:layouts',
        't3up:fix:filetype',
        't3up:fix:grid2',
        'hdapersonen:update:plugin',
    ];

    /**
     * Commands that must NOT receive --dry-run.
     * Note: 't3up:symlink:fonts' is skipped entirely when --dry-run is active.
     */
    private const NO_DRY_RUN_FOR = [
        't3up:symlink:fonts',
        't3up:set:owner-perms',
        't3up:update:spacing',
    ];

    protected function configure(): void
    {
        $this
            ->setAliases(['t3up:u:13'])
            ->setDescription(self::$defaultDescription)
            ->addOption('force', 'f', InputOption::VALUE_NONE, 'Forward --force to most subcommands.')
            ->addOption('dry-run', 'd', InputOption::VALUE_NONE, 'Forward --dry-run to most subcommands; skips font symlink.')
            ->addOption('path', 'p', InputOption::VALUE_REQUIRED, 'Forwarded to t3up:set:owner-perms if provided.')
            ->addOption('continue-on-error', 'c', InputOption::VALUE_NONE, 'Continue sequence on error instead of aborting.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $app = $this->getApplication();
        if ($app === null) {
            $output->writeln('<error>Unable to get application instance.</error>');
            return Command::FAILURE;
        }

        $force = (bool)$input->getOption('force');
        $dryRun = (bool)$input->getOption('dry-run');
        $path = $input->getOption('path');
        $continueOnError = (bool)$input->getOption('continue-on-error');

        // start with core commands
        $commands = self::COMMANDS;

        // append optional commands if their extension is loaded
        foreach (self::OPTIONAL_COMMANDS as $extKey => $cmdNames) {
            if (
                class_exists(\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::class)
                && \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded($extKey)
            ) {
                foreach ((array)$cmdNames as $cmdName) {
                    $commands[$cmdName] = [];
                }
            }
        }

        $noForceFor = self::NO_FORCE_FOR;
        $noDryRunFor = self::NO_DRY_RUN_FOR;

        $summary = [];

        foreach ($commands as $name => $_) {
            $output->writeln('');
            $output->writeln("<info>Running command:</info> {$name}");

            // If dry-run, skip the font symlink entirely.
            if ($dryRun && $name === 't3up:symlink:fonts') {
                $output->writeln("<comment>Skipping {$name} in dry-run mode.</comment>");
                $summary[$name] = 'skipped (dry-run)';
                continue;
            }

            try {
                $command = $app->find($name);
            } catch (\Throwable $e) {
                // command not available => skip
                $output->writeln("<comment>Command not available, skipping: {$name}</comment>");
                $summary[$name] = 'not-available';
                if (!$continueOnError) {
                    return Command::FAILURE;
                }
                continue;
            }

            // Build arguments for the subcommand
            $arrayArgs = ['command' => $name];

            // Forward --force unless excluded for this command
            if ($force && !in_array($name, $noForceFor, true)) {
                $arrayArgs['--force'] = true;
            }

            // Forward --dry-run unless excluded for this command
            if ($dryRun && !in_array($name, $noDryRunFor, true)) {
                $arrayArgs['--dry-run'] = true;
            }

            // Forward --path specifically to owner-perms
            if ($path && $name === 't3up:set:owner-perms') {
                $arrayArgs['--path'] = (string)$path;
            }

            $arrayInput = new ArrayInput($arrayArgs);

            try {
                $returnCode = $command->run($arrayInput, $output);
            } catch (\Throwable $e) {
                $output->writeln("<error>Exception while running {$name}: {$e->getMessage()}</error>");
                $summary[$name] = 'exception';
                if (!$continueOnError) {
                    return Command::FAILURE;
                }
                continue;
            }

            if ($returnCode === Command::SUCCESS) {
                $output->writeln("<info>Command completed successfully: {$name}</info>");
                $summary[$name] = 'success';
            } else {
                $output->writeln("<error>Command returned error code {$returnCode}: {$name}</error>");
                $summary[$name] = "failed ({$returnCode})";
                if (!$continueOnError) {
                    $output->writeln('');
                    $output->writeln('<comment>Summary so far:</comment>');
                    foreach ($summary as $c => $status) {
                        $output->writeln(" - {$c} : {$status}");
                    }
                    return Command::FAILURE;
                }
            }
        }

        // Final summary
        $output->writeln('');
        $output->writeln('<info>All commands finished. Summary:</info>');
        foreach ($summary as $c => $status) {
            $output->writeln(" - {$c} : {$status}");
        }

        $allOk = array_reduce($summary, fn($carry, $s) => $carry && $s === 'success', true);
        return $allOk ? Command::SUCCESS : Command::FAILURE;
    }
}
