<?php

namespace App\Repositories;

use App\Exceptions\ConversionException;
use App\Post;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Illuminate\Support\Facades\Storage;

class SnappyPdfRepository extends RepositoryAbstract implements PDFRepositoryInterface
{

    /**
     * Save generated PDF to local default download folder
     *
     * @param null $post
     *
     * @return mixed
     * @throws \App\Exceptions\ConversionException
     */
    public function download($post = null)
    {
        $filename = null;
        if (is_object($post) || request('post_id')) {
            $post = is_object($post) ? $post : Post::findOrFail($this->request->post_id);
            $filename = 'post_' . $post->id . '.pdf';
        }
        elseif (request('url')) {
            $filename = str_replace('/', '_', request('url'));
            $filename = str_replace('.', '', $filename);
        }

        if(Storage::exists('public/' . $filename)) {
            return true;
        }

        $pdf = $this->getPDF($post);

        return $this->save($pdf, $filename);
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
        PDF::setOption('load-error-handling', 'ignore');

        if (is_object($post) || request('post_id')) {
            $pdf = PDF::loadView('posts.pdf', ['post' => $post]);
        }

        elseif (request('html')) {
            $pdf = PDF::loadHTML(request('html'));
        }
        elseif (request('url')) {
            $pdf = PDF::loadFile(request('url'));
        }
        else {
            throw new ConversionException('Unsupported PDF conversion in request ' . request());
        }

        return $pdf;
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

        return $pdf->inline();
    }

    /**
     * Save the pdf with given filename, or generate random string for filename
     *
     * @param      $pdf
     * @param null $filename
     *
     * @return bool
     */
    private function save($pdf, $filename = null)
    {
        PDF::setTemporaryFolder(storage_path('tmp'));

        $filename = $filename ?: str_random(16);
        $pdf->save(storage_path('app/public/' . $filename));

        return true;
    }
}
