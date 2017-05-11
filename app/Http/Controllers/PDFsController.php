<?php

namespace App\Http\Controllers;

use App\Mail\BlogPostLinkPDF;
use App\Mail\BlogPostPDF;
use App\Post;
use App\Repositories\PDFRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PDFsController extends Controller
{

    /**
     * @var \App\Http\Controllers\PDFRepositoryInterface
     */
    private $pdf;

    /**
     * PDFsController constructor.
     *
     * @param \App\Repositories\PDFRepositoryInterface $pdf
     */
    public function __construct(PDFRepositoryInterface $pdf)
    {

        $this->pdf = $pdf;
    }

    /**
     * Stream a generated PDF to the browser window
     *
     * @return mixed
     */
    public function show()
    {
        return $this->pdf->stream();
    }

    /**
     * Save requested PDF to default downloads folder
     *
     * @return mixed
     */
    public function download()
    {
        return $this->pdf->download();
    }

    /**
     * Send email with link to pdf of requested post_id
     */
    public function email()
    {
        try {
            if(request('post_id')) {
                $url = route('posts.pdf', request('post_id'));
            }
            else {
                $url = request('url');
            }

            Mail::to(request('email'))
                ->send(new BlogPostLinkPDF($url));

            return redirect(back());
        }
        catch(\Exception $e) {

            $this->logError($e);

            return redirect(back())
                ->withErrors('Email could not be sent.');
        }
    }
}
