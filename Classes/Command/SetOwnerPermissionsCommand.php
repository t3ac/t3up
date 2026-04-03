<?php
declare(strict_types=1);

namespace T3ac\T3up\Command;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

final class SetOwnerPermissionsCommand extends Command
{
    protected static $defaultName = 't3up:set:owner-perms';
    protected static $defaultDescription = 'Set owner/group to www-data and set read/write permissions recursively. Dry-run by default. Use --force to apply.';

    protected function configure(): void
    {
        $this
            ->setAliases(['t3up:s:p'])
            ->addOption('path', 'p', InputOption::VALUE_REQUIRED, 'Directory to operate on (defaults to project root)', null)
            ->addOption('force', 'f', InputOption::VALUE_NONE, 'Apply changes (without this option the command does a dry-run)')
            ->addOption('skip-errors', 's', InputOption::VALUE_NONE, 'Don\'t abort on permission errors, continue and report them');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $force = (bool)$input->getOption('force');
        $skipErrors = (bool)$input->getOption('skip-errors');

        // Default project root (like in your other commands)
        $projectRoot = dirname(__DIR__, 5);
        $pathOption = $input->getOption('path');
        $targetPath = $pathOption ? (string)$pathOption : $projectRoot;

        if (!is_dir($targetPath)) {
            $output->writeln("<error>Pfad existiert nicht oder ist kein Verzeichnis: {$targetPath}</error>");
            return Command::FAILURE;
        }

        // Check functions availability
        $canChown = function_exists('chown');
        $canChgrp = function_exists('chgrp');
        $canChmod = function_exists('chmod');

        $output->writeln("<info>Target:</info> {$targetPath}");
        $output->writeln($force ? '<comment>Running in EXECUTE mode (changes will be applied)</comment>' : '<comment>Dry-run mode — no changes will be applied. Use --force to apply.</comment>');
        $output->writeln('');

        if (!$canChown || !$canChgrp || !$canChmod) {
            $output->writeln('<comment>Warnung: Einige Dateifunktionen sind nicht verfügbar auf diesem System:</comment>');
            $output->writeln(' - chown: ' . ($canChown ? 'yes' : 'no'));
            $output->writeln(' - chgrp: ' . ($canChgrp ? 'yes' : 'no'));
            $output->writeln(' - chmod: ' . ($canChmod ? 'yes' : 'no'));
            $output->writeln('<comment>Auf vielen Shared-Hosting-Systemen sind chown/chgrp deaktiviert oder nicht wirksam.</comment>');
            if (!$force) {
                $output->writeln('');
            }
        }

        $dirIterator = new RecursiveDirectoryIterator($targetPath, RecursiveDirectoryIterator::SKIP_DOTS);
        $iterator = new RecursiveIteratorIterator($dirIterator, RecursiveIteratorIterator::SELF_FIRST);

        $changed = 0;
        $errors = [];

        /** @var \SplFileInfo $item */
        foreach ($iterator as $item) {
            $filePath = $item->getPathname();

            // Decide mode
            if ($item->isDir()) {
                $mode = 0775; // owner rwx, group r-x, others r-x
            } else {
                // keep executable files executable (e.g. scripts)
                $isExec = is_executable($filePath);
                $mode = $isExec ? 0775 : 0664;
            }

            // Actions to perform (dry-run: just print)
            $actions = [];

            if ($canChown) {
                $actions[] = "chown(www-data)";
            }
            if ($canChgrp) {
                $actions[] = "chgrp(www-data)";
            }
            if ($canChmod) {
                $actions[] = sprintf('chmod(%o)', $mode);
            }
// comment out if you want to see the exact changes, but otherwise it's too confusing.
//            $output->writeln(sprintf(' -> %s : %s', $filePath, implode(', ', $actions)));

            if ($force) {
                // perform operations, collect errors
                if ($canChown) {
                    $ok = @chown($filePath, 'www-data');
                    if ($ok === false) {
                        $errors[] = "chown failed: {$filePath}";
                        if (!$skipErrors) {
                            $output->writeln("<error>chown failed for {$filePath}</error>");
                            return Command::FAILURE;
                        }
                    }
                }

                if ($canChgrp) {
                    $ok = @chgrp($filePath, 'www-data');
                    if ($ok === false) {
                        $errors[] = "chgrp failed: {$filePath}";
                        if (!$skipErrors) {
                            $output->writeln("<error>chgrp failed for {$filePath}</error>");
                            return Command::FAILURE;
                        }
                    }
                }

                if ($canChmod) {
                    $ok = @chmod($filePath, $mode);
                    if ($ok === false) {
                        $errors[] = "chmod failed: {$filePath}";
                        if (!$skipErrors) {
                            $output->writeln("<error>chmod failed for {$filePath}</error>");
                            return Command::FAILURE;
                        }
                    }
                }

                $changed++;
            }
        }

        $output->writeln('');
        if ($force) {
            $output->writeln("<info>Fertig. Bearbeitete Einträge: {$changed}</info>");
            if (!empty($errors)) {
                $output->writeln('<comment>Es gab einige Fehler (siehe Liste):</comment>');
                foreach ($errors as $e) {
                    $output->writeln(' - ' . $e);
                }
                $output->writeln('');
                $output->writeln('<comment>Falls chown/chgrp fehlschlagen, läuft der Prozess wahrscheinlich unter einem anderen Benutzer oder die Funktionen sind systemseitig eingeschränkt.</comment>');
                return Command::SUCCESS; // finish but notify
            }
            return Command::SUCCESS;
        }

        $output->writeln('<info>Dry-run complete. Keine Änderungen vorgenommen.</info>');
        $output->writeln('<comment>Um Änderungen anzuwenden: wiederholen mit --force</comment>');

        return Command::SUCCESS;
    }
}
