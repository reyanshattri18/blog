<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class PostService {

    /**
     * URL for the website
     *
     * @var string
     */
    private $url;

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct () {
        $this->url = config('services.blog.url');
    }

    /**
     * Fetch Posts from the website
     *
     * @return Illuminate\Support\Collection
     */
    public function get () {
        $response = Http::get($this->url);
        $data = json_decode($response, true);
        return collect($data['data'] ?? []);
    }
}