<?php

namespace App\Http\Controllers;

use App\Mail\BlogPostLinkPDF;
use App\Post;
use App\Repositories\PDFRepositoryInterface;
use Illuminate\Support\Facades\Mail;

class PostsController extends Controller
{

    /**
     * Repository interface, bound in RepositoryServiceProvider
     *
     * @var \App\Repositories\PDFRepositoryInterface
     * @see \App\Providers\RepositoryServiceProvider
     */
    private $pdf;

    /**
     * PostsController constructor.
     *
     * @param \App\Repositories\PDFRepositoryInterface $pdf
     */
    public function __construct(PDFRepositoryInterface $pdf)
    {
        $this->pdf = $pdf;
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

            return back();
        }
        catch(\Exception $e) {

            $this->logError($e);

            return back()
                ->withErrors('Email could not be sent.');
        }
    }

    /**
     * Return all posts
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('posts.index')
            ->with('posts', Post::all());
    }

    /**
     * Fetch the specified post
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post                $post
     *
     * @return \Illuminate\View\View
     */
    public function show(Post $post)
    {
        return view('posts.show')
            ->with('post', $post);
    }

    /**
     * Generate a PDF file for given POST or log error and redirect to post index
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Post                $post
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function pdf(Post $post) {
        try {
            $success = $this->pdf->download($post);
            session()->flash('success', 'PDF Created');
            if($success) {
                return redirect(route('posts.index'));
            }
        }
        catch(\Exception $e) {
            $this->logError($e);

            return back()
                ->withErrors('Could not process PDF');
        }
    }
}
