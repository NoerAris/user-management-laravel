<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExampleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name; // Data yang akan dikirim dalam email

    // Constructor untuk menerima data
    public function __construct($name)
    {
        $this->name = $name;
    }

    // Mengatur email untuk dikirim
    public function build()
    {
        return $this->view('emails.user_created')  // Menentukan view yang akan digunakan
        ->with(['name' => $this->name])  // Mengirim data ke view
        ->subject('Contoh Email Laravel');
    }
}
