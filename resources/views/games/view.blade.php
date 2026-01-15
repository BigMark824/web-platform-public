@extends('layouts.app')

@section('title', 'Sample Game - WebPlatform')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Game Header -->
    <div class="flex flex-col lg:flex-row gap-8 mb-8">
        <!-- Game Carousel -->
        <div class="w-full lg:w-[640px]">
            <div class="carousel w-full rounded-lg overflow-hidden">
                @for ($i = 1; $i <= 5; $i++)
                <div id="slide{{ $i }}" class="carousel-item relative w-full">
                    <img src="https://placehold.co/640x360" class="w-full" />
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                        <a href="#slide{{ $i-1 == 0 ? 5 : $i-1 }}" class="btn btn-circle">❮</a>
                        <a href="#slide{{ $i+1 > 5 ? 1 : $i+1 }}" class="btn btn-circle">❯</a>
                    </div>
                </div>
                @endfor
            </div>
            <!-- Carousel Indicators -->
            <div class="flex justify-center w-full py-2 gap-2">
                @for ($i = 1; $i <= 5; $i++)
                <a href="#slide{{ $i }}" class="btn btn-xs">{{ $i }}</a>
                @endfor
            </div>
        </div>

        <!-- Game Info -->
        <div class="flex-1">
            <div class="card bg-base-200 h-full">
                <div class="card-body flex flex-col justify-between">
                    <div class="space-y-6">
                        <div>
                            <h1 class="text-3xl font-bold mb-2">{{ $game->name ?? "Unknown"}}</h1>
                            <p class="text-sm opacity-70">By <a href="/user/{{ $game->creator_id ?? 0}}" class="link">@ {{ $game->creator ?? "Unknown"}} </a></p>
                        </div>

                        <!-- Game Rating -->
                        <div>
                            <div class="flex items-center gap-4 mb-4">
                                <div class="flex-1 h-2 bg-base-300 rounded-full">
                                    <div class="h-2 bg-success rounded-full" style="width: 85%"></div>
                                </div>
                                <span class="text-sm">85%</span>
                            </div>
                            <div class="flex justify-between text-sm opacity-70">
                                <span>{{ number_format(rand(10000, 50000)) }} votes</span>
                                <button class="btn btn-ghost btn-sm">
                                    <i class="fas fa-heart"></i> {{ number_format(rand(1000, 5000)) }}
                                </button>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex gap-4">
                            <button class="btn btn-success flex-1">
                                <i class="fas fa-play mr-2"></i> Play
                            </button>
                            <div class="dropdown dropdown-end">
                                <button class="btn btn-ghost" tabindex="0">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-200 rounded-box w-52">
                                    <li><a><i class="fas fa-flag mr-2"></i> Report</a></li>
                                    <li><a><i class="fas fa-share mr-2"></i> Share</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Game Content -->
    <div class="flex flex-col lg:flex-row gap-8">
        <div class="flex-1">
            <!-- Tabs -->
            <div class="tabs tabs-boxed mb-6">
                <a class="tab tab-active">About</a>
                <a class="tab">Store</a>
                <a class="tab">Servers</a>
                <a class="tab">Badges</a>
            </div>

            <!-- About Section -->
            <div class="card bg-base-200">
                <div class="card-body">
                    <h3 class="text-lg font-bold mb-4">Description</h3>
                    <p class="whitespace-pre-line mb-8">{{ $game->description ?? "Unknown"}}</p>

                    <!-- Game Stats -->
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                        <div class="stat bg-base-300/50 rounded-box p-4">
                            <div class="stat-title text-xs">Playing</div>
                            <div class="stat-value text-primary text-lg">{{ number_format(rand(1000, 5000)) }}</div>
                        </div>
                        <div class="stat bg-base-300/50 rounded-box p-4">
                            <div class="stat-title text-xs">Visits</div>
                            <div class="stat-value text-lg">{{ number_format(rand(100000, 1000000)) }}</div>
                        </div>
                        <div class="stat bg-base-300/50 rounded-box p-4">
                            <div class="stat-title text-xs">Created</div>
                            <div class="stat-value text-lg">{{ $game->created_at ?? "Unknown"}}</div>
                        </div>
                        <div class="stat bg-base-300/50 rounded-box p-4">
                            <div class="stat-title text-xs">Updated</div>
                            <div class="stat-value text-lg">{{ $game->updated_at ?? "Unknown"}}</div>
                        </div>
                        <div class="stat bg-base-300/50 rounded-box p-4">
                            <div class="stat-title text-xs">Max Players</div>
                            <div class="stat-value text-lg">12</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection