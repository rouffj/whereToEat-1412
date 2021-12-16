<?php

class FakeMailer extends StmpMailer
{
    private $emails = [];

    public function send($to, $title, $body)
    {
        $this->emails[] = [
            'to' => $to,
            'title' => $title,
            'body' => $body
        ];
    }

    public function getEmails()
    {
        return $this->emails;
    }
}