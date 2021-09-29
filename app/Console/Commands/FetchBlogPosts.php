<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Events\BlogPostAdded;
use App\Services\BlogService;
use Illuminate\Console\Command;

class FetchBlogPosts extends Command
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
    protected $description = 'Fetch Blog Posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    
    private $blogService;

    public function __construct(BlogService $blogService)
    {
        parent::__construct();
        $this->blogService = $blogService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $currentTime = now()->toDateTimeString();

        $data = $this->blogService->get();

        if ($data && is_array($data) && count($data)) {
            $data = array_map(function ($item) use ($currentTime) {
                $item['created_at'] = $currentTime;
                $item['updated_at'] = $currentTime;
                return $item;
            }, $data);
    
            $chunks = array_chunk($data, 1);
    
            foreach ($chunks as $chunk) {
                Post::insert($chunk);
            }
            event(new BlogPostAdded);
        }
    }
}
