<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $email,
        public string $password
    ) {}

    public function build()
    {
        return $this->from(config('mail.from.address'))
                    ->subject('User Created Mail')
                    ->view('emails.user-created')
                    ->with([
                        'email' => $this->email,
                        'password' => $this->password,
                    ]);
    }
}
