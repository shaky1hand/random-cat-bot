<?php

namespace App\Service;

use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\Update;

class TelegramService
{
    private BotApi $bot;
    private int $offset = 0;

    public function __construct(string $telegramToken)
    {
        $this->bot = new BotApi($telegramToken);
    }

    public function handleUpdates(): void
    {
        while (true) {
            $updates = $this->bot->getUpdates($this->offset);

            foreach ($updates as $update) {
                // Если пришло новое сообщение
                if ($update->getMessage() !== null) {
                    $message = $update->getMessage();

                    if ($message->getText() === '/start') {
                        $this->bot->sendMessage(
                            $message->getChat()->getId(),
                            'Привет! Я бот, который отправляет фото котов.'
                        );
                    } elseif ($message->getText() === '/cat') {
                        $this->bot->sendMessage(
                            $message->getChat()->getId(),
                            'Сейчас отправлю тебе котика!'
                        );
                    } else {
                        $this->bot->sendMessage(
                            $message->getChat()->getId(),
                            'Ты написал: ' . $message->getText()
                        );
                    }
                }

                // Обновляем смещение, чтобы не получать одно и то же сообщение
                $this->offset = $update->getUpdateId() + 1;
            }
        }
    }
}