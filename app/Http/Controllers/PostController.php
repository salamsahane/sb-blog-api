<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Http\Responses\ApiResponse;
use App\Repositories\PostRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct(private PostRepository $postRepository)
    {
    }

    public function index(): JsonResponse
    {
        $posts = $this->postRepository->getAll();
        return ApiResponse::send(PostResource::collection($posts));
    }

    public function store(PostRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $this->handleImageUpload($request, $validated);

        $post = $this->postRepository->store($validated);
        
        return ApiResponse::send(new PostResource($post), 'Post created successfully', 201);
    }

    public function show(int $id): JsonResponse
    {
        $post = $this->postRepository->getById($id);
        return ApiResponse::send(new PostResource($post));
    }

    public function update(PostRequest $request, int $id): JsonResponse
    {
        $validated = $request->validated();

        $this->handleImageUpload($request, $validated);

        $post = $this->postRepository->update($id, [...$validated, 'slug' => Str::slug($validated['title'])]);

        return ApiResponse::send($post, 'Post updated successfully');
    }

    private function handleImageUpload(PostRequest $request, array &$validated): void
    {
        if (!$request->hasFile('image')) return;

        $validated['image'] = $request->file('image')->store('images', 'public');
    }

    public function destroy(int $id): JsonResponse
    {
        /** @var \App\Models\Post $post */
        $post = $this->postRepository->getById($id);

        if ($post->image) Storage::disk('public')->delete($post->image);

        $deleteResult = $this->postRepository->delete($id);

        return ApiResponse::send($deleteResult, 'Post deleted successfully');
    }
}
