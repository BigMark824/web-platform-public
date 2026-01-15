<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Play') }}
                    </x-nav-link>
                </div>
            </div>
            
                                
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <form method="POST" action="{{ route('login') }}" class="flex items-center gap-2">
                    @csrf

                    <x-text-input 
                        id="username" 
                        class="p-3 w-28 sm:w-32 focus:outline-none focus:ring-0" 
                        type="text" 
                        name="username" 
                        :value="old('username')" 
                        required 
                        autofocus 
                        autocomplete="username" 
                        placeholder="Username"
                    />

                    <x-text-input 
                        id="password" 
                        class="p-3 w-28 sm:w-32 focus:outline-none focus:ring-0" 
                        type="password" 
                        name="password" 
                        required 
                        autocomplete="current-password" 
                        placeholder="Password"
                    />

                    <button type="submit" class="btn btn-primary text-white rounded">
                        {{ __('Log in') }}
                    </button>

                    @if ($errors->any())
                        <script>
                            alert("{{ implode(' ', $errors->all()) }}");
                        </script>
                    @endif
                </form>
            </div>

    </div>
</nav>
