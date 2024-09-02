<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements RepositoryInterface
{
  /**
   * Get all users.
   * 
   * @return Collection<int, User>
   */
  public function getAll(): Collection
  {
    return User::all();
  }

  /**
   * Get post by ID.
   * 
   * @param int $id
   * 
   * @return User
   */
  public function getById(int $id): User
  {
    return User::findOrFail($id);
  }

  /**
   * Get user by a given column
   * 
   * @param string $column
   * @param mixed $value
   * 
   * @return User
   */
  public function getUserBy(string $column, mixed $value): User
  {
    return User::where($column, $value)->firstOrFail();
  }

  /**
   * Store new user.
   * 
   * @param array<string, mixed> $data
   * 
   * @return User
   */
  public function store(array $data): User
  {
    return User::create($data);
  }

  /**
   * Update user.
   * 
   * @param int $id
   * @param array<string, mixed> $data
   * 
   * @return bool
   */
  public function update(int $id, array $data): bool
  {
    return User::where('id', $id)->update($data);
  }

  /**
   * Delete a user by ID.
   * 
   * @param int $id
   * 
   * @return bool
   */
  public function delete(int $id): bool
  {
    return User::destroy($id);
  }
}