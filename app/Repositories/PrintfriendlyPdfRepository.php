<?php

namespace App\Repositories;

use App\Exceptions\ConversionException;
use App\Post;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class PrintfriendlyPdfRepository extends RepositoryAbstract implements PDFRepositoryInterface
{

    /**
     * Save the PDF to local default download folder
     *
     * @param null $post
     */
    public function download($post = null)
    {
        return $this->getPDF($post);
    }

    /**
     * Stream the pdf to the browser
     *
     * @param null $post
     */
    public function stream($post = null)
    {
        return $this->getPDF($post);
    }

    /**
     * Get the rendered PDF from the PrintFriendly service
     *
     * @param null $post
     * @throws ConversionException
     *
     * @return mixed
     */
    public function getPDF($post = null)
    {
        $curl = curl_init("https://api.printfriendly.com/v1/pdfs/create");
        $params = [];

        curl_setopt_array($curl, array(
            CURLOPT_USERAGENT => '98c4f4f0ca952e9abba1d225f1376887:',
            CURLOPT_POST => '1'
        ));

        if(is_object($post)) {
            $params['html'] = $post->content;
        }
        elseif(request('post_id')) {
            $post = Post::findOrFail($this->request->post_id);
            $params['html'] = route('posts.pdf', $post->id);
        }
        elseif(request('url')) {
            $params['page_url'] = request('url');
        }
        elseif(request('html')) {
            $params['html'] = request('html');
        }

        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);

        $result = json_decode(curl_exec($curl));

        curl_close($curl);

        if(array_key_exists('error', $result['body'])) {
            throw new ConversionException('An error occurred during conversion : ' . $result['body']['error']);
        }

        return $result['body'];
    }
}
