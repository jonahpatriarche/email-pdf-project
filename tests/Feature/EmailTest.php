<?php

namespace Tests\Feature;

use App\Mail\BlogPostPDF;
use App\Post;
use Illuminate\Support\Facades\Mail;
use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class EmailTest
 *
 * @package Tests\Feature
 * @group emails
 */
class EmailTest extends BrowserKitTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function it_sends_email_with_attachment()
    {
        Mail::fake();

        $data = [
            'post_id' => Post::first()->id,
            'email' => 'jojonah@me.com'
        ];

        $this->post(route('email.pdf'), $data);

        Mail::assertSent(BlogPostPDF::class);
    }
}
