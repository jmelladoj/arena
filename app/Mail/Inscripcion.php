<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Atleta;

class Inscripcion extends Mailable
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
        return $this->from('inscripciones@torneoarena.cl')
                    ->replyTo('inscripciones@torneoarena.cl', 'YA FALTA POCO PARA COMPLETAR TU REGISTRO EN TORNEO ARENA 2019')
                    ->subject('YA FALTA POCO PARA COMPLETAR TU REGISTRO EN TORNEO ARENA 2019')
                    ->view('inscripcion')
                    ->with([
                        'atleta' => $this->atleta
                    ]);
    }
}
