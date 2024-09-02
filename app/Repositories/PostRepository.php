<?php

namespace App\Repositories;
use App\Interfaces\RepositoryInterface;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements RepositoryInterface
{

  /**
   * Get all posts.
   * 
   * @return Collection<int, Post>
   */
  public function getAll(): Collection
  {
    return Post::all();
  }

  /**
   * Get post by ID.
   * 
   * @param int $id
   * 
   * @return Post
   */
  public function getById(int $id): Post
  {
    return Post::findOrFail($id);
  }

  /**
   * Store new post.
   * 
   * @param array<string, mixed> $data
   * 
   * @return Post
   */
  public function store(array $data): Post
  {
    return Post::create($data);
  }

  /**
   * Update post.
   * 
   * @param int $id
   * @param array<string, mixed> $data
   * 
   * @return bool
   */
  public function update(int $id, array $data): bool
  {
    return Post::where('id', $id)->update($data);
  }

  /**
   * Delete a post by ID.
   * 
   * @param int $id
   * 
   * @return bool
   */
  public function delete(int $id): bool
  {
    return Post::destroy($id);
  }
}