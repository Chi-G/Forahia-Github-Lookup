<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 relative z-10">
    
    {{-- Back Button navigation --}}
    <div class="mb-8 flex items-center">
        <a href="{{ route('home') }}" class="group flex items-center gap-2 text-slate-400 hover:text-cyan-400 transition font-medium">
            <span class="bg-slate-800/80 border border-white/5 p-2 rounded-lg group-hover:bg-cyan-500/10 group-hover:border-cyan-500/30 transition">
                <i class="fa-solid fa-chevron-left"></i>
            </span>
            Back to Directory
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        {{-- Left Column: Profile Summary & Tech Analyzer --}}
        <div class="lg:col-span-4 flex flex-col gap-8">
            
            {{-- Main Profile Card --}}
            <div class="bg-slate-800/30 backdrop-blur-xl border border-white/10 rounded-3xl p-6 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-cyan-500/20 to-transparent rounded-bl-full -mr-10 -mt-10 blur-xl"></div>
                
                <div class="relative flex flex-col items-center text-center">
                    <div class="relative mb-4">
                        <div class="absolute -inset-1 bg-gradient-to-r from-cyan-500 via-blue-500 to-indigo-500 rounded-full blur opacity-70"></div>
                        <img src="{{ $userData['avatar_url'] }}" class="relative w-32 h-32 rounded-full border-4 border-slate-900 object-cover" alt="{{ $userData['login'] }}">
                    </div>
                    
                    <h1 class="text-2xl font-bold text-white flex items-center gap-2">
                        {{ $userData['name'] ?? $userData['login'] }}
                    </h1>
                    <p class="text-cyan-400 font-semibold">@ {{ $userData['login'] }}</p>

                    @if(isset($userData['bio']))
                        <p class="mt-4 text-slate-400 text-sm leading-relaxed">{{ $userData['bio'] }}</p>
                    @endif

                    <div class="flex flex-wrap gap-2 justify-center mt-5">
                        <span class="bg-slate-800/80 border border-white/10 text-slate-300 text-xs font-bold px-3 py-1 rounded-full">{{ $userData['type'] ?? 'User' }}</span>
                        @if(isset($userData['hireable']) && $userData['hireable'])
                            <span class="bg-green-500/10 border border-green-500/30 text-green-400 text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1"><i class="fa-solid fa-circle text-[8px]"></i> Open to Work</span>
                        @endif
                    </div>

                    <div class="w-full mt-6 border-t border-white/5 pt-6 text-left space-y-3 text-slate-300 text-sm">
                        @if(!empty($userData['location']))
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-location-dot w-5 text-slate-500"></i>
                                <span>{{ $userData['location'] }}</span>
                            </div>
                        @endif
                        @if(!empty($userData['blog']))
                            @php
                                $websiteUrl = str_starts_with($userData['blog'], 'http') ? $userData['blog'] : 'https://' . $userData['blog'];
                            @endphp
                            <div class="flex items-center gap-3 overflow-hidden">
                                <i class="fa-solid fa-link w-5 text-slate-500"></i>
                                <a href="{{ $websiteUrl }}" target="_blank" class="text-cyan-400 hover:underline truncate">{{ parse_url($websiteUrl, PHP_URL_HOST) }}</a>
                            </div>
                        @endif
                        @if(!empty($userData['twitter_username']))
                             <div class="flex items-center gap-3">
                                <i class="fa-brands fa-twitter w-5 text-slate-500"></i>
                                <a href="https://twitter.com/{{ $userData['twitter_username'] }}" target="_blank" class="hover:text-cyan-400">@ {{ $userData['twitter_username'] }}</a>
                            </div>
                        @endif
                    </div>

                    <a href="{{ $userData['html_url'] }}" target="_blank" class="mt-8 w-full bg-white/5 hover:bg-white/10 border border-white/10 text-white font-bold py-3 px-4 rounded-xl transition flex justify-center items-center gap-2">
                        <i class="fa-brands fa-github text-lg"></i> View GitHub Profile
                    </a>
                </div>
            </div>

            {{-- Tech Stack Analyzer (INNOVATIVE FEATURE) --}}
            <div class="bg-slate-800/30 backdrop-blur-xl border border-white/10 rounded-3xl p-6 relative overflow-hidden">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-bold text-white">Tech Stack Analytics</h3>
                    <i class="fa-solid fa-chart-pie text-cyan-500/50 text-xl"></i>
                </div>

                @if(count($topLanguages) > 0)
                    <div class="space-y-5">
                        @foreach($topLanguages as $lang)
                            <div>
                                <div class="flex justify-between text-sm mb-1.5">
                                    <span class="text-slate-200 font-medium">{{ $lang['name'] }}</span>
                                    <span class="text-slate-400">{{ $lang['percentage'] }}%</span>
                                </div>
                                <div class="h-2 w-full bg-slate-900 rounded-full overflow-hidden border border-white/5">
                                    @php
                                        $colors = ['bg-cyan-500', 'bg-indigo-500', 'bg-blue-500', 'bg-teal-500', 'bg-purple-500'];
                                        $assignedColor = $colors[$loop->index % count($colors)];
                                    @endphp
                                    <div class="h-full {{ $assignedColor }} rounded-full shadow-[0_0_8px_rgba(0,0,0,0.3)]" style="width: {{ $lang['percentage'] }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center text-slate-500 py-4 text-sm italic">
                        Insufficient codebase data for stack visual analysis.
                    </div>
                @endif
            </div>
        </div>

        {{-- Right Column: Statistics & Repository Explorer --}}
        <div class="lg:col-span-8 flex flex-col gap-8">
            
            {{-- Statistics Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-slate-800/20 backdrop-blur-xl border border-white/5 p-5 rounded-2xl flex flex-col items-center">
                    <div class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-2">Followers</div>
                    <div class="text-2xl md:text-3xl font-black text-white">{{ number_format($userData['followers'] ?? 0) }}</div>
                </div>
                <div class="bg-slate-800/20 backdrop-blur-xl border border-white/5 p-5 rounded-2xl flex flex-col items-center">
                    <div class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-2">Following</div>
                    <div class="text-2xl md:text-3xl font-black text-white">{{ number_format($userData['following'] ?? 0) }}</div>
                </div>
                <div class="bg-slate-800/20 backdrop-blur-xl border border-white/5 p-5 rounded-2xl flex flex-col items-center">
                    <div class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-2">Repositories</div>
                    <div class="text-2xl md:text-3xl font-black text-white">{{ number_format($userData['public_repos'] ?? 0) }}</div>
                </div>
                <div class="bg-slate-800/20 backdrop-blur-xl border border-white/5 p-5 rounded-2xl flex flex-col items-center">
                    <div class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-2">Gists</div>
                    <div class="text-2xl md:text-3xl font-black text-white">{{ number_format($userData['public_gists'] ?? 0) }}</div>
                </div>
            </div>

            {{-- Repository Feed --}}
            <div class="bg-slate-900/40 border border-white/10 rounded-3xl flex flex-col overflow-hidden">
                <div class="p-6 border-b border-white/5 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white">Latest Contribution Hub</h3>
                    <span class="bg-cyan-500/10 text-cyan-400 text-xs font-bold px-3 py-1 rounded-full border border-cyan-500/30">Sorted by Activity</span>
                </div>

                <div class="p-2 flex flex-col divide-y divide-white/5" wire:loading.remove wire:target="nextRepoPage, previousRepoPage">
                    @forelse($repos as $repo)
                        <div class="p-4 hover:bg-white/5 transition-colors group">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div class="flex-1">
                                    <a href="{{ $repo['html_url'] }}" target="_blank" class="text-lg font-bold text-white group-hover:text-cyan-400 transition flex items-center gap-2">
                                        {{ $repo['name'] }}
                                        <i class="fa-solid fa-arrow-up-right-from-square text-xs opacity-0 group-hover:opacity-100 transition"></i>
                                    </a>
                                    <p class="text-slate-400 text-sm mt-1 line-clamp-2">{{ $repo['description'] ?? 'No description listed.' }}</p>
                                    
                                    <div class="flex flex-wrap items-center gap-4 mt-3 text-xs font-medium">
                                        @if(!empty($repo['language']))
                                            <span class="flex items-center gap-1.5 text-slate-300">
                                                <span class="w-2 h-2 rounded-full bg-cyan-500"></span>
                                                {{ $repo['language'] }}
                                            </span>
                                        @endif
                                        <span class="text-slate-500 flex items-center gap-1"><i class="fa-solid fa-star"></i> {{ number_format($repo['stargazers_count']) }}</span>
                                        <span class="text-slate-500 flex items-center gap-1"><i class="fa-solid fa-code-fork"></i> {{ number_format($repo['forks_count']) }}</span>
                                        <span class="text-slate-500 flex items-center gap-1"><i class="fa-solid fa-circle-exclamation"></i> {{ number_format($repo['open_issues_count']) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center text-slate-500 italic">
                            Zero public repositories discovered.
                        </div>
                    @endforelse
                </div>

                {{-- Localized Repo Loading --}}
                <div wire:loading wire:target="nextRepoPage, previousRepoPage" class="p-20 text-center">
                    <div class="inline-block w-8 h-8 border-4 border-cyan-500/30 border-t-cyan-500 rounded-full animate-spin"></div>
                </div>

                {{-- Repository Pagination --}}
                <div class="bg-slate-800/40 p-4 border-t border-white/5 flex justify-between items-center">
                    <div class="text-slate-400 text-sm font-medium">
                         Page <span class="text-white font-bold">{{ $repoPage }}</span> of {{ ceil(($userData['public_repos'] ?? 1) / $reposPerPage) }}
                    </div>
                    
                    <div class="flex gap-2">
                        <button 
                            wire:click="previousRepoPage"
                            @if($repoPage <= 1) disabled @endif
                            class="bg-slate-900 border border-white/10 hover:bg-slate-800 text-white p-2 px-4 rounded-lg text-sm font-bold transition disabled:opacity-30"
                        >
                            <i class="fa-solid fa-arrow-left"></i>
                        </button>
                        <button 
                            wire:click="nextRepoPage"
                            @if(($repoPage * $reposPerPage) >= ($userData['public_repos'] ?? 0)) disabled @endif
                            class="bg-slate-900 border border-white/10 hover:bg-slate-800 text-white p-2 px-4 rounded-lg text-sm font-bold transition disabled:opacity-30"
                        >
                            <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
