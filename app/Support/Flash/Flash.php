<?php

namespace App\Support\Flash;

use Illuminate\Contracts\Session\Session;
use function config;

final class Flash
{
    public const MESSAGE_KEY = 'crm_flash_message';
    public const MESSAGE_CLASS_KEY = 'crm_flash_class';

    public function __construct(protected Session $session)
    {
    }

    public function get(): ?FlashMessage
    {
        $message = $this->session->get(self::MESSAGE_KEY);

        if (!$message) {
            return null;
        }

        return new FlashMessage(
            $message,
            $this->session->get(self::MESSAGE_CLASS_KEY, '')
        );
    }

    public function info(string $message): void
    {
        $this->flash($message, 'info');
    }

    public function alert(string $message): void
    {
        $this->flash($message, 'alert');
    }

    private function flash(string $message, string $name)
    {
        $this->session->flash(self::MESSAGE_KEY, $message);
        $this->session->flash(self::MESSAGE_CLASS_KEY, config("flash.$name", ''));
    }
}
