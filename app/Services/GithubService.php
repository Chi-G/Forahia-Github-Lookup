<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

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
        $cacheKey = "github_search_" . md5($query . "_p" . $page . "_s" . $perPage);

        return Cache::remember($cacheKey, now()->addMinutes(10), function () use ($query, $page, $perPage) {
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
        });
    }

    /**
     * Get details of a specific user.
     */
    public function getUser(string $login)
    {
        $cacheKey = "github_user_" . strtolower($login);

        return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($login) {
            $response = $this->client()->get("/users/{$login}");

            if ($response->failed()) {
                return null;
            }

            return $response->json();
        });
    }

    /**
     * Get repositories of a specific user with pagination.
     */
    public function getUserRepos(string $login, int $page = 1, int $perPage = 5)
    {
        $cacheKey = "github_repos_" . strtolower($login) . "_p" . $page . "_s" . $perPage;

        return Cache::remember($cacheKey, now()->addMinutes(60), function () use ($login, $page, $perPage) {
            $response = $this->client()->get("/users/{$login}/repos", [
                'sort' => 'updated',
                'page' => $page,
                'per_page' => $perPage,
            ]);

            if ($response->failed()) {
                return [];
            }

            return $response->json();
        });
    }
}
