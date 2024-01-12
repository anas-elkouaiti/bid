<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $sender_name;
    public $sender_mail;
    public $subject;
    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sender_name, $sender_mail, $subject, $body)
    {
        $this->sender_name = $sender_name;
        $this->sender_mail = $sender_mail;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->sender_mail, $this->sender_name)
                    ->markdown('emails.welcome')->with([
                        'name' => $this->sender_name,
                        'sender' => $this->sender_mail,
                        'body' => $this->body
                    ]);
    }
}
