<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        // If we don't already have a sample post, let's create one.
        if (!Post::where('title', 'Sample Blog Post')->exists()) {
            $user = User::firstOrCreate([]);
            Post::create(
                [
                    'user_id' => $user->id,
                    'title'   => 'Sample Blog Post',
                    'excerpt' => 'This is a sample post on a WordPress blog, created with the visual editor',

                    'content' => 'This is a sample post on a WordPress blog, created with the visual editor
                        <h2>Section 1</h2>
                        <p>Artisan assumenda chill
                        <img class="alignleft size-medium wp-image-16"
                            src="https://jonahsampleblog.files.wordpress.com/2017/05/person-smartphone-office-table.jpeg?w=300"
                            alt="Placeholder Image"
                            width="300"
                            height="200"
                        />
                          wave biodiesel, 8-bit cillum pinterest bicycle rights prism flannel everyday carry. Sriracha
                          four dollar toast delectus keytar, subway tile do nesciunt pork belly hexagon excepteur.
                          Celiac craft beer ad velit voluptate. Nostrud VHS aliqua truffaut vero. Yr mollit duis
                          cold-pressed, seitan dreamcatcher williamsburg blog hammock microdosing. Yr art party laboris
                          lumbersexual tofu, messenger bag small batch. Lumbersexual chartreuse vaporware health goth,
                          vice copper mug tote bag plaid delectus af officia williamsburg.</p>
                        <h2>Section 2</h2>
                        <ol>
                            <li>This is a numbered list</li>
                            <li>None of its elements have any meaning</li>
                            <li>Now it\'s finished.</li>
                        </ol>
                        <h2>Section 3</h2>
                        <p>Non et cornhole tempor tacos. Kitsch magna pork belly food truck, organic normcore enamel pin
                        microdosing. Pariatur jean shorts
                         <img class=" size-medium wp-image-15 alignright"
                            src="https://jonahsampleblog.files.wordpress.com/2017/05/stairs-lights-abstract-bubbles1.jpg?w=300"
                            alt="Placeholder Image"
                            width="300"
                            height="200"
                        /> hot chicken copper mug kickstarter fingerstache, pickled velit comodo pug retro tumeric
                        occupy. Pork belly readymade officia raclette. Kombucha skateboard adipisicing air plant
                        literally, neutra proident gentrify. Pug nihil hashtag proident swag chartreuse. Heirloom
                        consequat you probably haven\'t heard of them vexillologist disrupt, meggings hella microdosing
                        helvetica pork belly.</p>

                        <p>8-bit cillum pinterest bicycle rights prism flannel everyday carry. Sriracha
                        four dollar toast delectus keytar, subway tile do nesciunt pork belly hexagon excepteur.
                        Celiac craft beer ad velit voluptate. Nostrud VHS aliqua truffaut vero. Yr mollit duis
                        cold-pressed, seitan dreamcatcher williamsburg blog hammock microdosing. Yr art party laboris
                        lumbersexual tofu, messenger bag small batch. Lumbersexual chartreuse vaporware health goth,
                        vice copper mug tote bag plaid delectus af officia williamsburg.</p>
                        '
                ]
            );
        }

    }
}
