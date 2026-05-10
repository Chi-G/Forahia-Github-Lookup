<x-layouts.app>
    <div class="max-w-4xl mx-auto py-20 relative">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-cyan-500/20 blur-3xl rounded-full pointer-events-none"></div>
        
        <div class="relative bg-slate-800/30 backdrop-blur-xl border border-white/10 rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center gap-12">
            <div class="shrink-0">
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-500 blur-xl opacity-40 rounded-full animate-pulse"></div>
                    <img src="/favicon.png" alt="DevRadar" class="relative w-40 h-40 object-contain invert brightness-200 drop-shadow-2xl" />
                </div>
            </div>
            
            <div class="text-center md:text-left flex-1">
                <h1 class="text-4xl font-black text-white mb-2 tracking-tight">
                    About <span class="text-cyan-400">DevRadar</span>
                </h1>
                <div class="inline-block px-3 py-1 bg-white/5 border border-white/10 rounded-lg text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">
                    Intelligence Platform
                </div>
                
                <p class="text-slate-300 text-lg leading-relaxed mb-8">
                    DevRadar is a cutting-edge scouting instrument designed to provide deep transparency into the Open Source landscape. Instantly decode developer DNA, inspect contribution velocity, and evaluate engineering footprints with precision precision analytics.
                </p>
                
                <div class="grid grid-cols-2 gap-6 text-sm">
                    <div>
                        <span class="text-slate-500 block mb-1 uppercase font-bold text-xs">Platform Engine</span>
                        <span class="text-white font-medium">Laravel 13 + Livewire</span>
                    </div>
                    <div>
                        <span class="text-slate-500 block mb-1 uppercase font-bold text-xs">Intelligence By</span>
                        <a href="https://www.forahia.com" target="_blank" class="text-cyan-400 font-bold hover:underline flex items-center gap-1">
                            Forahia Solutions <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
