@extends('layouts.app')

@section('title', 'Games - WebPlatform')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Filters Bar -->
    <div class="flex flex-col sm:flex-row gap-4 mb-8">
        <div class="flex-1 flex flex-wrap gap-2">
            <select class="select select-bordered w-40">
                <option selected>Popular</option>
                <option>Top Earning</option>
                <option>Top Rated</option>
                <option>Featured</option>
            </select>
            <select class="select select-bordered w-32">
                <option selected>All Games</option>
                <option>Adventure</option>
                <option>RPG</option>
                <option>FPS</option>
                <option>Racing</option>
                <option>Simulator</option>
            </select>
        </div>
        <div class="form-control w-full sm:w-64 flex-none">
            <div class="join w-full">
                <input type="text" placeholder="Search games..." class="input input-bordered join-item w-full" />
                <button class="btn join-item">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Popular Games Section -->
    <div class="mb-12">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold">Popular Games</h2>
                <p class="text-sm opacity-70">Most played right now</p>
            </div>
            <button class="btn btn-ghost btn-sm">See All</button>
        </div>
        <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
            @foreach ($games as $game)
                <x-game-card :game="$game" />
            @endforeach
        </div>
    </div>

    <!-- Featured Games Section -->
    <div class="mb-12">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold">Featured</h2>
                <p class="text-sm opacity-70">Hand-picked games for you</p>
            </div>
            <button class="btn btn-ghost btn-sm">See All</button>
        </div>
        <div class="flex flex-wrap gap-4 justify-center lg:justify-start">
            @for ($i = 1; $i <= 4; $i++)
            <a href="{{ route('games.view', ['id' => $i]) }}" class="card bg-base-200 shadow-xl hover:shadow-2xl transition-all hover:scale-105 hover:bg-base-300 w-[150px] shrink-0">
                <figure>
                    <img src="https://placehold.co/150x150" alt="Game" class="h-[150px] w-[150px] object-cover" />
                </figure>
                <div class="card-body p-3">
                    <h3 class="card-title text-sm">Featured {{ $i }}</h3>
                    <div class="flex items-center text-xs opacity-70 gap-2">
                        <div class="flex items-center gap-1">
                            <i class="fas fa-users"></i>
                            <span>{{ number_format(rand(100, 1000)) }}</span>
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
            @endfor
        </div>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mt-8">
        <div class="join">
            <button class="join-item btn">«</button>
            <button class="join-item btn btn-active">1</button>
            <button class="join-item btn">2</button>
            <button class="join-item btn">3</button>
            <button class="join-item btn">»</button>
        </div>
    </div>
</div>
@endsection