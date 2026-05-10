<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GithubService
{
    protected $baseUrl;
    protected $token;

    public function __construct()
    {
        $this->baseUrl = config('services.github.url');
        $this->token = config('services.github.token');
    }

    protected function client()
    {
        $client = Http::baseUrl($this->baseUrl);

        if ($this->token) {
            $client->withToken($this->token);
        }

        return $client;
    }

    /**
     * Search users by keyword with pagination.
     */
    public function searchUsers(string $query, int $page = 1, int $perPage = 30)
    {
        $response = $this->client()->get('/search/users', [
            'q' => $query,
            'page' => $page,
            'per_page' => $perPage
        ]);

        if ($response->failed()) {
            return ['items' => [], 'total_count' => 0];
        }

        return [
            'items' => $response->json('items') ?? [],
            'total_count' => $response->json('total_count') ?? 0,
        ];
    }

    /**
     * Get details of a specific user.
     */
    public function getUser(string $login)
    {
        $response = $this->client()->get("/users/{$login}");

        if ($response->failed()) {
            return null;
        }

        return $response->json();
    }

    /**
     * Get repositories of a specific user with pagination.
     */
    public function getUserRepos(string $login, int $page = 1, int $perPage = 5)
    {
        $response = $this->client()->get("/users/{$login}/repos", [
            'sort' => 'updated',
            'page' => $page,
            'per_page' => $perPage,
        ]);

        if ($response->failed()) {
            return [];
        }

        return $response->json();
    }
}
