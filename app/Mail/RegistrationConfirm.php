<?php

namespace App\Mail;

use App\Users;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegistrationConfirm extends Mailable
{
    use Queueable, SerializesModels;


	public $email;
	public $key;

	/**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$key)
    {
		$this->email = $email;
		$this->key = $key;



        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirmation');
    }
}
