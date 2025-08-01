<?php

namespace App\Service;

use TelegramBot\Api\BotApi;
use TelegramBot\Api\Types\Message;
use TelegramBot\Api\Types\Update;

class TelegramService
{
    private BotApi $bot;
    private CatApiService $catApiService;
    private int $offset = 0;

    public function __construct(string $telegramToken, CatApiService $catApiService)
    {
        $this->bot = new BotApi($telegramToken);
        $this->catApiService = $catApiService;
    }

    public function handleUpdates(): void
    {
        while (true) {
            $updates = $this->bot->getUpdates($this->offset);

            foreach ($updates as $update) {
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

                        $catUrl = $this->catApiService->getRandomCatUrl();

                        if ($catUrl) {
                            $this->bot->sendPhoto(
                                $message->getChat()->getId(), 
                                $catUrl
                            );
                        } else {
                            $this->bot->sendMessage(
                                $message->getChat()->getId(),
                                'Прости, не могу найти котика. Попробуй ещё раз!'
                            );
                        }
                    } else {
                        $this->bot->sendMessage(
                            $message->getChat()->getId(),
                            'Ты написал: ' . $message->getText()
                        );
                    }
                }

                $this->offset = $update->getUpdateId() + 1;
            }
        }
    }
}