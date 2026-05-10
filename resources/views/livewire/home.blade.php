<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
    
    {{-- Hero Header Section --}}
    <div class="text-center mb-16 relative z-10 {{ count($users) > 0 ? 'mb-10' : 'py-24' }} transition-all duration-700">
        <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-white mb-6">
            Scout the <span class="bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 via-blue-500 to-indigo-500">Future</span> of Tech.
        </h1>
        <p class="text-slate-400 text-lg md:text-xl max-w-2xl mx-auto mb-10">
            Discover incredible developers, dive into their open-source impact, and traverse the entire GitHub ecosystem with precision.
        </p>

        {{-- Enhanced Search Form --}}
        <div class="max-w-2xl mx-auto relative">
            <form wire:submit.prevent="searchUsers" class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-cyan-500 to-indigo-500 rounded-2xl blur opacity-25 group-hover:opacity-40 transition duration-300"></div>
                <div class="relative flex bg-slate-900/80 backdrop-blur-xl border border-white/10 rounded-2xl shadow-2xl overflow-hidden items-center pr-2 h-16">
                    <div class="pl-6 flex items-center text-slate-500">
                         <i class="fa-solid fa-magnifying-glass text-xl"></i>
                    </div>
                    <input
                        type="text"
                        class="w-full bg-transparent px-4 text-lg text-white focus:outline-none placeholder-slate-500 font-medium"
                        placeholder="Type GitHub username or nickname..."
                        wire:model.defer="search"
                    />
                    <button
                        type="submit"
                        class="bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-500 hover:to-blue-500 text-white font-bold px-8 py-2 rounded-xl transition shadow-lg hover:shadow-cyan-500/20"
                    >
                        Launch
                    </button>
                </div>
            </form>

            {{-- Small Reset Action --}}
            @if(count($users) > 0)
                <div class="mt-4 text-center">
                    <button wire:click="clearUsers" class="text-slate-500 hover:text-white text-sm font-semibold transition uppercase tracking-widest flex items-center gap-2 mx-auto">
                        <i class="fa-solid fa-xmark"></i> Clear Search
                    </button>
                </div>
            @endif

            {{-- Notification Alerts --}}
            @if($alert)
            <div class="absolute w-full mt-4 flex justify-center animate-fade-in-down">
                <div class="bg-rose-900/30 backdrop-blur border border-rose-500/30 text-rose-300 px-6 py-3 rounded-xl flex items-center gap-3 text-sm font-medium shadow-xl shadow-rose-500/10">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    {{ $alert }}
                </div>
            </div>
            @endif
        </div>
    </div>

    {{-- Loading State --}}
    <div wire:loading class="w-full text-center py-20">
        <div class="relative w-16 h-16 mx-auto mb-4">
             <div class="absolute inset-0 border-4 border-cyan-500/30 border-t-cyan-500 rounded-full animate-spin"></div>
        </div>
        <p class="text-cyan-400 font-bold tracking-widest uppercase text-xs animate-pulse">Interrogating GitHub API...</p>
    </div>

    {{-- Search Results Grid --}}
    <div wire:loading.remove>
        @if(count($users) > 0)
        <div class="flex flex-col gap-8 animate-fade-in">
            
            {{-- Top Info & Pagination bar --}}
            <div class="flex justify-between items-center px-2">
                <h3 class="text-slate-400 font-medium">
                    Detected <span class="text-white font-bold">{{ number_format($totalCount) }}</span> developers
                </h3>
            </div>

            {{-- The Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($users as $user)
                    <a href="{{ route('user.detail', ['login' => $user['login']]) }}" class="group relative flex flex-col bg-slate-800/30 backdrop-blur-sm border border-white/5 rounded-2xl p-6 hover:border-cyan-500/30 hover:bg-slate-800/60 hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                        {{-- Hover Glow Effect --}}
                        <div class="absolute -inset-x-4 -inset-y-4 bg-gradient-to-br from-cyan-500/0 to-blue-500/0 group-hover:from-cyan-500/10 group-hover:to-blue-500/5 transition duration-500 -z-10"></div>

                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <div class="absolute -inset-1 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full opacity-0 group-hover:opacity-100 blur-sm transition"></div>
                                <img src="{{ $user['avatar_url'] }}" class="relative w-16 h-16 rounded-full object-cover border-2 border-slate-700 group-hover:border-cyan-400/50 transition" alt="{{ $user['login'] }}">
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="text-lg font-bold text-slate-200 truncate group-hover:text-white transition">{{ $user['login'] }}</h4>
                                <p class="text-slate-500 text-sm truncate">@github</p>
                            </div>
                            <div class="text-slate-600 group-hover:text-cyan-400 transition transform group-hover:translate-x-1">
                                <i class="fa-solid fa-arrow-right"></i>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            {{-- Bottom Pagination Controls --}}
            <div class="mt-12 flex items-center justify-between border-t border-white/5 pt-6 pb-12">
                <div class="text-slate-400 text-sm">
                    Showing <span class="text-white font-semibold">{{ (($page - 1) * $perPage) + 1 }}</span> - 
                    <span class="text-white font-semibold">{{ min(($page * $perPage), $totalCount) }}</span> 
                </div>
                
                <div class="flex gap-2">
                    <button 
                        wire:click="previousPage" 
                        @if($page <= 1) disabled @endif
                        class="btn bg-slate-800/50 border border-white/10 hover:bg-slate-700 text-slate-300 rounded-xl disabled:opacity-30 disabled:cursor-not-allowed"
                    >
                        <i class="fa-solid fa-chevron-left mr-1"></i> Prev
                    </button>

                    <span class="flex items-center px-4 bg-slate-900 border border-cyan-500/30 text-cyan-400 font-bold rounded-xl text-sm">
                        Page {{ $page }}
                    </span>

                    <button 
                        wire:click="nextPage" 
                        @if(($page * $perPage) >= $totalCount) disabled @endif
                        class="btn bg-slate-800/50 border border-white/10 hover:bg-slate-700 text-slate-300 rounded-xl disabled:opacity-30 disabled:cursor-not-allowed"
                    >
                        Next <i class="fa-solid fa-chevron-right ml-1"></i>
                    </button>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
.animate-fade-in {
    animation: fadeIn 0.5s ease-out forwards;
}
.animate-fade-in-down {
    animation: fadeInDown 0.3s ease-out forwards;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes fadeInDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
