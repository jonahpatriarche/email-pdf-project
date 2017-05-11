<?php

namespace Tests\Feature;

use App\Mail\BlogPostLinkPDF;
use App\Post;
use Illuminate\Support\Facades\Mail;
use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class PostsTest
 *
 * @package Tests\Unit
 * @group posts
 */
class PostsTest extends BrowserKitTestCase
{

    /**
     * Test that a post can be fetched
     * @todo - create ModelFactory for Post to avoid issues if seeder has not been run
     *
     * @test
     */
    public function it_fetches_an_individual_post()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        $post = Post::first();

        /** * * *
         * ACT  *
         * * * **/
        $this->visit(route('posts.show', $post->id));

        /** * * *
         * TEST *
         * * * **/
        $this->assertResponseOk();
        $this->assertViewHas('post');
        $this->see($post->title);
    }

    /**
     * Check that index of all posts is displayed without errors
     *
     * @test
     */
    public function it_lists_all_posts()
    {
        /** * * * *
         * SETUP  *
         * * * * **/

        # No setup required

        /** * * *
         * ACT  *
         * * * **/
        $this->visit(route('posts.index'));

        /** * * *
         * TEST *
         * * * **/
        $this->assertResponseOk();
        $this->assertViewHas('posts');
    }

    /**
     * Checks that sending a request using the form on a blog post sends a new mail message
     *
     * @test
     */
    public function it_emails_pdf_to_given_email()
    {
        /** * * * *
         * SETUP  *
         * * * * **/
        Mail::fake();
        $post = Post::first();

        /** * * *
         * ACT  *
         * * * **/
        $this->visit(route('posts.show', $post->id));
        $this->assertResponseOk();

        $this->type('jojonah@icloud.com', 'email')
            ->press('Send');

        /** * * *
         * TEST *
         * * * **/
        $this->assertResponseOk();
        Mail::assertSent(BlogPostLinkPDF::class);
    }

    /**
    * @group uut
     * Checks that sending email without faking causes no errors, and email is sent to mailtrap account
     *
     * @test
     */
    public function it_sends_email_to_review_in_mailtrap()
    {
        /** * * * *
         * SETUP  *
         * * * * **/

        # Make sure that mail driver is set to Mailtrap
        putenv('MAIL_HOST=smtp.mailtrap.io');
        $post = Post::first();

        /** * * *
         * ACT  *
         * * * **/
        $this->visit(route('posts.show', $post->id));
        $this->assertResponseOk();

        $this->type('jojonah@icloud.com', 'email')
            ->press('Send');

        /** * * *
         * TEST *
         * * * **/
        $this->assertResponseOk();
    }
}
