<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;

class PostTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;


    public function test_a_post_can_be_added()
    {

        // $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/posts',[
            'title' => 'test',
            'description' => 'test',
            'publication_date' => '2021-09-30'
        ]);

        $response->assertStatus(302);
        $this->assertCount(1, Post::all());
    }
    
    public function test_a_title_is_required()
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/posts',[
            'title' => '',
            'description' => 'test',
            'publication_date' => '2021-09-30'
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_a_description_is_required()
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/posts',[
            'title' => 'Test',
            'description' => '',
            'publication_date' => '2021-09-30'
        ]);

        $response->assertSessionHasErrors('description');
    }

    public function test_a_publication_date_is_required()
    {

        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/posts',[
            'title' => 'Test',
            'description' => 'des',
            'publication_date' => ''
        ]);

        $response->assertSessionHasErrors('publication_date');
    }

    public function test_a_post_can_be_updated()
    {

        $user = User::factory()->create();

        $this->actingAs($user)->post('/posts' , [
            'title' => 'Cool Title',
            'description' => 'Cool Description',
            'publication_date' => '2021-12-31'
        ]);

        $post = Post::first();

        $response = $this->patch('/posts/'. $post->id,[
            'title' => 'New Title',
            'description' => 'New Description',
            'publication_date' => '2021-01-01'
        ]);

        $this->assertEquals('New Title', Post::first()->title);
        $this->assertEquals('New Description', Post::first()->description);
        $this->assertEquals('2021-01-01', Post::first()->publication_date);

        // $response->assertRedirect($post->fresh()->path());
    }
    
    public function test_a_post_can_be_deleted()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/posts' , [
            'title' => 'Cool Title',
            'description' => 'Cool Description',
            'publication_date' => '2021-12-31'
        ]);

        $post = Post::first();
        $this->assertCount(1, Post::all());

        $response = $this->delete('/posts/'.$post->id);

        $this->assertCount(0, Post::all());
        $response->assertRedirect('/posts');
    }
    
}
