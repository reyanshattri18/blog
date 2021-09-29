<?php
namespace App\Services;

class BlogService {

    public $url;

    public function __construct () {
        $this->url = config('services.blog.url');
    }

    public function get () {
        $data = file_get_contents($this->url);
        return json_decode($data, true);
    }
}