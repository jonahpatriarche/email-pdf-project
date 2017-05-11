<?php

namespace App\Http\Controllers;

use App\Post;
use Barryvdh\DomPDF\PDF;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class PostsController extends Controller
{

    public function index(Request $request)
    {
        return view('posts.index')
            ->with('posts', Post::all());
    }

    public function show(Request $request, Post $post)
    {
        return view('posts.show')
            ->with('post', $post);
    }

    public function pdf(Request $request, Post $post) {
        try {
            $client = new Client();
            $res = $client->request('GET', 'https://api.printfriendly.com/v1/pdfs/create', [
                'form_params' => [
                    'page_url' => route($request->post_url)
                ]
            ]);

            echo $res->getStatusCode();

            echo $res->getHeader('content-type');

            echo $res->getBody();

            /*$pdf = App::make('dompdf.wrapper');
            $pdf->loadHTML($post->content);

            # Display pdf in browser
            return $pdf->stream();*/

            # Alternatively, we can download the file:
            // return $pdf->download('blog_' . $post['id'] . '.pdf');
        }
            /* If something goes wrong, write to log and redirect to posts index */
        catch(\Exception $e) {
            $this->logError($e);

            return redirect(route('posts.index'));
        }
    }
}
