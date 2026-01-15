<div>
    <a href="{{ route('games.view', ['id' => $game->id]) }}" class="card bg-base-200 shadow-xl hover:shadow-2xl transition-all hover:scale-105 hover:bg-base-300 w-[150px] shrink-0">
        <figure class="relative">
            <img src="https://placehold.co/150x150" alt="Game Thumbnail" class="h-[150px] w-[150px] object-cover" />
        </figure>
        <div class="card-body p-3">
            <h3 class="card-title text-sm">{{ $game->name }}</h3>
            <div class="flex items-center text-xs opacity-70 gap-2">
                <div class="flex items-center gap-1">
                    <i class="fas fa-user"></i> 
                    <span>{{ $game->creator ?? "Unknown" }}</span>
                </div>
                <div class="flex items-center gap-1">
                    <i class="fas fa-users"></i>
                    <span>{{ number_format(0) }}</span>
                </div>
            </div>
            <div class="mt-2">
                <div class="flex items-center gap-2">
                    <div class="flex-1 h-1.5 bg-base-300 rounded-full">
                        <div class="h-1.5 bg-success rounded-full" style="width: {{ rand(60, 95) }}%"></div>
                    </div>
                    <span class="text-xs opacity-70">{{ rand(60, 95) }}%</span>
                </div>
            </div>
        </div>
    </a>
</div>