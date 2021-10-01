<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * will store the Post Model
     *
     * @var Model Object
     */
    private $post;

    /**
     * constructor
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }
    /**
     * It will return the list view of posts
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $posts = $this->post->orderbyPublicationDate()->paginate(10);

        return view($request->ajax() ? 'home.listing' : 'home.index')->with(compact('posts'));
    }
}
