<?php


namespace App\Mailer;


use Symfony\Component\Mailer\Mailer;

class EmailGenerator
{
    private $attachment;

    public function __construct()
    {
        $this->attachment = "";
    }

    public function sendEmail(string $target)
    {
    }
}
