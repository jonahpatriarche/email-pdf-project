<?php

namespace App\Repositories;

use App\Exceptions\ConversionException;
use App\Mail\BlogPostLinkPDF;
use App\Mail\BlogPostPDF;
use App\Post;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DomPdfRepository extends RepositoryAbstract implements PDFRepositoryInterface
{

    /**
     * Save generated PDF to local default download folder and return true when complete
     *
     * @param null $post
     *
     * @return boolean
     * @throws \App\Exceptions\ConversionException
     */
    public function download($post = null)
    {
        $pdf = $this->getPDF($post);

        $pdf->download(str_random(16));

        return true;
    }

    /**
     * Use request's html or post_id field or the optional post param to generate PDF using domPdf package.
     *
     * @param null $post
     *
     * @return mixed
     * @throws \App\Exceptions\ConversionException
     */
    public function getPDF($post = null)
    {
        PDF::setOptions(['isPhpEnabled' => true, 'isHtml5ParserEnabled' => true, 'debugCss' => true]);

        if(is_object($post)) {
            return PDF::loadView('posts.pdf', ['post' => $post]);
        }
        elseif(request('post_id')) {
            $post = Post::findOrFail($this->request->post_id);

            return PDF::loadView('posts.pdf', ['post' => $post]);
        }
        elseif(request('html')) {
            return PDF::loadHTML(request('html'));
        }
        elseif(request('url')) {
            PDF::loadFile(request('url'))->save('/path-to/my_stored_file.pdf')->stream('download.pdf');
        }
        else {
            throw new ConversionException('Unsupported PDF conversion in request ' . request());
        }
    }

    /**
     * Stream the generated PDF to the browser window
     *
     * @param null $post
     *
     * @return mixed
     * @throws \App\Exceptions\ConversionException
     */
    public function stream($post = null)
    {
        $pdf = $this->getPDF($post);

        return $pdf->stream();
    }
}
