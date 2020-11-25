<?php

namespace App\Mail\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Productomail extends Mailable
{
    use Queueable, SerializesModels;

    public $elcorreo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($elcorreo)
    {
        $this->elcorreo=$elcorreo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('19170038@uttcampus.edu.mx')
                    ->view('Productos');
    }
}
