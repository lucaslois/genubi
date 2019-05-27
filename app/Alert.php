<?php


namespace App;


class Alert
{
    public function send(string $text) {
        session()->flash('alert', $text);
    }

    public function get() {
        return session('alert');
    }

    public function exists() {
        return session()->has('alert');
    }
}