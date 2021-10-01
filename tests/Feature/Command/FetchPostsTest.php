<?php

namespace Tests\Feature\Command;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class FetchPostsTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_can_fetch_posts_from_post_api()
    {
        $this->artisan('db:seed');
        $this->artisan('fetch:posts')
         ->expectsOutput('New posts added');
    }
}
