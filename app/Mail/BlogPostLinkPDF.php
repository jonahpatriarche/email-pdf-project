<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class BlogPostLinkPDF extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    private $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        try {
            $email = $this->markdown('mails.post-pdf', ['url' => $this->url]);

            return $email;
        }
        catch (\Exception $e) {
            Log::error(
                'An error occurred while rendering email:
                    Message: ' . $e->getMessage() . '
                    File: ' . $e->getFile() . ' (' . $e->getLine() . ')
                    Trace:
                    ' . $e->getTraceAsString()
            );
        }
    }
}
