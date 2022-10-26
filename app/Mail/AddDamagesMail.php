<?php

namespace App\Mail;

use App\Models\Damages;
use App\Models\Settings;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AddDamagesMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public  $details;
    public $ids;

    public function __construct( $details, $ids)
    {
        $this->details = $details;
        $this->ids = $ids;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Damages Added')
            ->view('backend.email.damages')->with([
                'details' => $this->details,
                'ids' => $this->ids,
            ]);
    }
}
