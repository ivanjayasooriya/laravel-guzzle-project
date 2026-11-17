<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RuntimeException;

class JsonPlaceholderService
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.jsonplaceholder.base_url'),
            'timeout' => 10,
            'verify' => false, // <-- Add this line to bypass SSL verification locally
            'headers' => [
                'Accept' => 'application/json',
            ],
        ]);
    }

    // GET: Fetch all posts
    public function getAllPosts(): array
    {
        return $this->request('GET', '/posts');
    }

    // GET: Fetch a single post
    public function getPost(int $id): array
    {
        return $this->request('GET', "/posts/{$id}");
    }

    // POST: Create a post
    public function createPost(array $data): array
    {
        return $this->request('POST', '/posts', [
            'json' => $data,
        ]);
    }

    // PUT: Update a post
    public function updatePost(int $id, array $data): array
    {
        return $this->request('PUT', "/posts/{$id}", [
            'json' => $data,
        ]);
    }

    // DELETE: Delete a post
    public function deletePost(int $id): array
    {
        return $this->request('DELETE', "/posts/{$id}");
    }

    // Common Guzzle request handler
    private function request(
        string $method,
        string $endpoint,
        array $options = []
    ): array {

        try {

            $response = $this->client->request(
                $method,
                $endpoint,
                $options
            );

            return json_decode(
                (string) $response->getBody(),
                true,
                512,
                JSON_THROW_ON_ERROR
            );

        } catch (GuzzleException | \JsonException $e) {

            throw new RuntimeException(
                'External API request failed: ' . $e->getMessage(),
                0,
                $e
            );
        }
    }
}
