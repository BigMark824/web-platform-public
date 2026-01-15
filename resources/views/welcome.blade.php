<x-guest-layout>

@section('title', 'Welcome to WebPlatform')

@php
    $gamesAvailableFormatted = number_format($gamesAvailable);
    if ($gamesAvailable >= 1000000) {
        $gamesAvailableFormatted = number_format($gamesAvailable / 1000000, 1) . 'M';
    } elseif ($gamesAvailable >= 1000) {
        $gamesAvailableFormatted = number_format($gamesAvailable / 1000, 1) . 'k';
    }
@endphp

    <!-- Hero Section -->
    <div class="hero min-h-[70vh] bg-base-200" style="background-image: url('https://images.gamebanana.com/img/ss/mods/64444d80a56ac.jpg'); background-size: cover; background-position: center;">
        <div class="hero-overlay bg-opacity-60"></div>
        <div class="hero-content text-center text-neutral-content">
            <div class="max-w-3xl">
                <img src="{{ env('LOGO_URL') }}" alt="WebPlatform" class="mx-auto mb-8 h-32 shadow-xl shadow-cyan-500/15">
                <p class="mb-8 text-lg text-white">Experience the nostalgia of 2016 Roblox. </p>
                <div class="flex gap-4 justify-center">
                    @auth
                        <a href="#" class="btn btn-primary btn-lg">
                            <i class="fas fa-gamepad mr-2"></i> Start Playing
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus mr-2"></i> Join Now
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-ghost btn-lg">
                            <i class="fas fa-sign-in-alt mr-2"></i> Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-20 bg-base-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Why {{ env('APP_NAME', 'WebPlatform') }}?</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="card bg-base-200 shadow-xl">
                    <div class="card-body items-center text-center">
                        <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-clock text-3xl text-primary"></i>
                        </div>
                        <h3 class="card-title">2016 Era</h3>
                        <p>Experience Roblox as it was in 2016, with all the features you know and love.</p>
                    </div>
                </div>

                <div class="card bg-base-200 shadow-xl">
                    <div class="card-body items-center text-center">
                        <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-users text-3xl text-primary"></i>
                        </div>
                        <h3 class="card-title">Active Community</h3>
                        <p>Join thousands of active players in a friendly and nostalgic community.</p>
                    </div>
                </div>

                <div class="card bg-base-200 shadow-xl">
                    <div class="card-body items-center text-center">
                        <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-shield-alt text-3xl text-primary"></i>
                        </div>
                        <h3 class="card-title">Cheat Detection</h3>
                        <p>Our advanced cheat detection ensures the safety of our Users!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="bg-base-200 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="stats shadow w-full">
                <div class="stat place-items-center">
                    <div class="stat-title">Active Players</div>
                    <div class="stat-value text-primary">0</div>
                    <div class="stat-desc">Online right now</div>
                </div>
                
                <div class="stat place-items-center">
                    <div class="stat-title">Games</div>
                    <div class="stat-value text-secondary">{{ $gamesAvailableFormatted  }}</div>
                    <div class="stat-desc">Available to play</div>
                </div>
                
                <div class="stat place-items-center">
                    <div class="stat-title">Catalog</div>
                    <div class="stat-value">100+</div>
                    <div class="stat-desc">Items available</div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
