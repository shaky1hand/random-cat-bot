<?php

namespace App\Command;

use App\Service\TelegramService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:run-bot',
    description: 'Runs the Telegram bot using long polling.',
)]
class TelegramBotCommand extends Command
{
    public function __construct(
        private TelegramService $telegramService
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Bot is running. Press Ctrl+C to stop.');

        $this->telegramService->handleUpdates();

        return Command::SUCCESS;
    }
}