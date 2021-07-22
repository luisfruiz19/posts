<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notificacion extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $email;
    public $proyect;
    public $dni;
    public $phone;
    public $contacted;
    public $comments;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$email,$proyect,$dni,$phone,$contacted,$comments)
    {
        $this->name = $name;
        $this->email = $email;
        $this->proyect = $proyect;
        $this->dni = $dni;
        $this->phone = $phone;
        $this->contacted = $contacted;
        $this->comments = $comments;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('luisfruiz19@gmail.com')
            ->markdown('emails.notification')
            ->with([
                       'name' => $this->name,
                       'email' => $this->email,
                       'proyect' => $this->proyect,
                       'dni' => $this->dni,
                       'phone' => $this->phone,
                       'contacted' => $this->contacted,
                       'comments' => $this->comments,

            ]);
    }
}
