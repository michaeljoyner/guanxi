<?php

namespace App\Http\FlashMessaging;


class Flasher
{
    protected $messageTypes = [
        'info',
        'success',
        'error',
        'warning'
    ];

    public function flash($title, $text, $type = 'info')
    {
        session()->flash('flash_message', [
            'type'  => $type,
            'title' => $title,
            'text'  => $text,
        ]);
    }

    public function __call($method, $args)
    {
        if (in_array($method, $this->messageTypes)) {
            return $this->flash($args[0], $args[1], $method);
        }
        throw new \Exception('Invalid method call');
    }
}