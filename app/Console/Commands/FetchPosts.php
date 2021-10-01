<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Events\PostAdded;
use App\Services\PostService;
use Illuminate\Console\Command;

class FetchPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Posts';
    
    /**
     * Post Service Instance
     * 
     * @var PostService
     */
    private $postService;


    /**
     * Flag to check if event should be fired
     * 
     * @var boolean
     */
    private $fireEvent;

    /**
     * Create a new command instance.
     *
     * @return void
    */
    public function __construct(PostService $postService)
    {
        parent::__construct();
        $this->fireEvent = false;
        $this->postService = $postService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $posts = $this->postService->get();

        $posts->each(function ($post)  {
            $postDb = $this->createPost($post); 
        });

        if ($this->fireEvent) event(new PostAdded);
    }

    /**
     * Insert or Update Post in Database
     * @param array $post
     * 
     * @return Model
     */
    private function createPost ($post) {
        $postDb = Post::updateOrCreate(
            ['title' => $post['title']],
            ['description' => $post['description'], 'publication_date' => $post['publication_date'], 'user_id' => 1]
        );

        if ($postDb->wasRecentlyCreated)
                $this->fireEvent = true;

        return $postDb;
    }
}
