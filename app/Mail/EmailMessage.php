<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    protected $message;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param string $message
     */
    public function __construct(string $subject, string $message)
    {
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this->from(env('MAILGUN_USER', 'not-reply@webdevel.com'), config('app.name'))
            ->subject($this->subject )
            ->view('emails.view', ['message' => $this->message]);
    }
}
