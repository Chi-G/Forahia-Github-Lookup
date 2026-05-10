<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\GithubService;

class Home extends Component
{
    public $search = '';
    public $users = [];
    public $alert = null;
    public $page = 1;
    public $totalCount = 0;
    public $perPage = 12;

    public function updatedSearch()
    {
        if (empty($this->search)) {
            $this->clearUsers();
        }
    }

    public function searchUsers(GithubService $github)
    {
        $this->alert = null;

        if (empty(trim($this->search))) {
            $this->alert = 'Please enter something to search...';
            return;
        }

        $this->page = 1;
        $this->fetchData($github);
    }

    public function nextPage(GithubService $github)
    {
        if (($this->page * $this->perPage) < $this->totalCount) {
            $this->page++;
            $this->fetchData($github);
        }
    }

    public function previousPage(GithubService $github)
    {
        if ($this->page > 1) {
            $this->page--;
            $this->fetchData($github);
        }
    }

    protected function fetchData(GithubService $github)
    {
        $result = $github->searchUsers($this->search, $this->page, $this->perPage);
        $this->users = $result['items'] ?? [];
        $this->totalCount = $result['total_count'] ?? 0;

        if (count($this->users) === 0 && $this->totalCount === 0) {
            $this->alert = 'No users found matching that query.';
        }
    }

    public function clearUsers()
    {
        $this->users = [];
        $this->search = '';
        $this->alert = null;
        $this->page = 1;
        $this->totalCount = 0;
    }

    public function render()
    {
        return view('livewire.home');
    }
}
