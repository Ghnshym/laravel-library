<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Lending;

class FineNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The lending instance.
     *
     * @var \App\Models\Lending
     */
    public $lending;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Lending  $lending
     * @return void
     */
    public function __construct(Lending $lending)
    {
        $this->lending = $lending;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Fine Notification')
                    ->view('emails.fine-notification'); // You should create a view file for your email content, e.g., fine-notification.blade.php
    }
}
