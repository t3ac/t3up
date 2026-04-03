<?php
declare(strict_types=1);

namespace T3ac\T3up\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class CreateFontsSymlinkCommand extends Command
{
    // command name
    protected static $defaultName = 't3up:symlink:fonts';

    protected function configure(): void
    {
        $this
            ->setAliases(['t3up:s:f'])
            ->setDescription('Create a symlink in public/ that points to vendor/hda/t3up/Resources/Public/Fonts');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        // Determine project root.
        // __DIR__ is: <project_root>/vendor/hda/t3up/Classes/Command
        // Going up 5 levels leads to <project_root>.
        $projectRoot = dirname(__DIR__, 5);

        $target = $projectRoot . '/vendor/hda/t3up/Resources/Public/Fonts';
        $link = $projectRoot . '/public/Fonts';

        // Check that the target fonts directory exists.
        if (!is_dir($target)) {
            $output->writeln("<error>Target directory does not exist: {$target}</error>");
            return Command::FAILURE;
        }

        // If a symlink exists, remove it so we can recreate.
        if (is_link($link)) {
            if (!@unlink($link)) {
                $output->writeln("<error>Failed to remove existing symlink: {$link}</error>");
                return Command::FAILURE;
            }
            $output->writeln("<info>Removed existing symlink: {$link}</info>");
        } elseif (file_exists($link)) {
            // If a real file or directory exists at the link location, we avoid removing it automatically.
            $output->writeln("<error>A file or directory already exists at {$link}. Refuse to overwrite.</error>");
            $output->writeln("<comment>Please remove or rename it manually, then run this command again.</comment>");
            return Command::FAILURE;
        }

        // Try to create the symlink.
        if (@symlink($target, $link)) {
            $output->writeln("<info>Symlink created:</info> {$link} → {$target}");
            return Command::SUCCESS;
        }

        $output->writeln("<error>Unable to create symlink: {$link} → {$target}</error>");
        return Command::FAILURE;
    }
}
