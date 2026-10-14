<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function getAll()
    {
        return Post::latest()->paginate(10);
    }

    public function getById(int $id): Post
    {
        return Post::findOrFail($id);
    }

    public function create(array $data): Post
    {
        return Post::create($data);
    }

    public function update(int $id, array $data): Post
    {
        $post = Post::findOrFail($id);

        $post->update($data);

        return $post;
    }

    public function delete(int $id): void
    {
        $post = Post::findOrFail($id);

        $post->delete();
    }
}