<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Atleta;

class Anular extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public function __construct(Atleta $atleta)
     {
         //
         $this->atleta = $atleta;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('inscripciones@torneoarena.cl', 'TORNEO ARENA')
                    ->replyTo('inscripciones@torneoarena.cl', 'LO SENTIMOS')
                    ->subject('LO SENTIMOS')
                    ->view('anular')
                    ->with([
                        'atleta' => $this->atleta
                    ]);
    }
}
