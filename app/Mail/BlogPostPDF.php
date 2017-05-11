<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BlogPostPDF extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    private $pdf;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.post-pdf')
            ->attachData($this->pdf, 'download.pdf');
    }
}
