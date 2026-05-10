<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\GithubService;

class UserDetail extends Component
{
    public $login;
    public $userData = [];
    public $repos = [];
    public $topLanguages = [];
    public $repoPage = 1;
    public $reposPerPage = 5;

    public function mount($login, GithubService $github)
    {
        $this->login = $login;
        $this->userData = $github->getUser($login);
        
        if (!$this->userData) {
            abort(404);
        }

        $this->fetchRepos($github);
        $this->analyzeTechStack($github);
    }

    public function nextRepoPage(GithubService $github)
    {
        $totalRepos = $this->userData['public_repos'] ?? 0;
        if (($this->repoPage * $this->reposPerPage) < $totalRepos) {
            $this->repoPage++;
            $this->fetchRepos($github);
        }
    }

    public function previousRepoPage(GithubService $github)
    {
        if ($this->repoPage > 1) {
            $this->repoPage--;
            $this->fetchRepos($github);
        }
    }

    protected function fetchRepos(GithubService $github)
    {
        $this->repos = $github->getUserRepos($this->login, $this->repoPage, $this->reposPerPage);
    }

    protected function analyzeTechStack(GithubService $github)
    {
        // Fetch a larger sample (top 50 repos) to determine overall tech stack profile
        $allRepos = $github->getUserRepos($this->login, 1, 50);
        
        $langs = [];
        foreach ($allRepos as $r) {
            if (!empty($r['language'])) {
                $l = $r['language'];
                $langs[$l] = ($langs[$l] ?? 0) + 1;
            }
        }

        arsort($langs);
        $total = array_sum($langs);

        $this->topLanguages = [];
        foreach (array_slice($langs, 0, 5, true) as $name => $count) {
            $this->topLanguages[] = [
                'name' => $name,
                'percentage' => $total > 0 ? round(($count / $total) * 100) : 0,
                'count' => $count,
            ];
        }
    }

    public function render()
    {
        return view('livewire.user-detail');
    }
}
