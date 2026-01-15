<footer class="footer footer-center p-10 bg-base-200 text-base-content">
    <div>
        <img src="{{ env('LOGO_SMALL_URL') }}" alt="WebPlatform" class="h-10">
        <p class="font-bold">
            {{ env('APP_NAME', 'WebPlatform') }}
        </p>
        <div class="grid grid-flow-col gap-4">
            <a href="#" class="hover:text-primary"><i class="fab fa-discord text-2xl"></i></a>
        </div>
    </div> 
</footer>
