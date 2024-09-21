@extends('layouts.app')
@section('content')


@section('meta')
    <meta name="description" content="Download your favorite content securely and quickly. Your loot awaits!">
@endsection
@section('content')
    <div class="relative overflow-hidden h-full">
        <div class="text-white max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-24 relative">
            <div class="absolute inset-0 z-0">
                <img src="{{ $listing->coverurl }}" alt="{{ $listing->title }} cover"
                    class="absolute h-full w-full object-cover">
                <div
                    class="absolute inset-0 before:absolute before:right-0 before:top-0 before:bottom-0 before:w-1/5 before:bg-gradient-to-l before:from-gray-950 before:to-transparent after:absolute after:left-0 after:top-0 after:bottom-0 after:w-1/2 after:bg-gradient-to-r after:from-gray-950 after:to-transparent z-10">
                </div>
                <div
                    class="absolute inset-0 before:absolute before:inset-0 before:bg-gradient-to-b before:from-gray-950 before:to-transparent before:z-10 after:absolute after:inset-0 after:bg-gradient-to-t after:from-gray-950 after:to-transparent after:via-gray-950/60 after:z-10">
                </div>
            </div>
            <div class="relative z-20 text-center">
                <h1 class="text-3xl tracking-tighter font-semibold line-clamp-1 hidden lg:block">Downloading:
                    {{ $listing->title }}</h1>
                <p class="mt-3 text-gray-300">Your loot will start downloading in <span id="countdown">5</span> seconds —
                    brace yourself!</p>
                <div id="download-status" class="hidden mt-4 text-green-400 font-semibold">
                    Your loot is downloading! If it doesn’t start automatically, hit the button below.
                </div>
                <div id="download-button" class="hidden mt-10">
                    <a href="{{ $download->link }}"
                        class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded" target="_blank">
                        Download Now
                    </a>
                </div>

                <iframe id="download-frame" class="hidden"></iframe>
            </div>
            <p id="animated-text" class="mt-3 text-gray-300 text-center mt-10"></p>
        </div>
    </div>

    <style>
        @keyframes smoothFadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-smooth-fade-in {
            animation: smoothFadeIn 0.3s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let timeLeft = 5; // 5 seconds
            const countdownElement = document.getElementById('countdown');
            const downloadButton = document.getElementById('download-button');
            const downloadStatus = document.getElementById('download-status');
            const downloadFrame = document.getElementById('download-frame');
            const animatedTextElement = document.getElementById('animated-text');

            const phrases = [
                "Ahoy sailor! Your treasure awaits.",
                "Buckle up, matey! Your loot is coming.",
                "Shiver me timbers! Your booty arrives.",
                "Yo ho ho! Prepare to receive your prize.",
                "Avast ye! Your digital gold is here.",
                "Downloading treasure, one torrent at a time!",
                "No loot box too pricey, no game too protected!",
                "No gold? No problem—just hit download!",
                "Game over for DRM, game on for us!",
                "Loot first, pay never—pirates honor!",
                "Achievement unlocked: Free gaming forever!",
                "Downloading faster than a ship on a tailwind!",
                "Sailing the high seas of downloads—no gold required!",
                "Ready your cannons! Your plunder is inbound.",
                "Brace yourself! Your booty is on the horizon.",
            ];
            const randomPhrase = phrases[Math.floor(Math.random() * phrases.length)];
            const words = randomPhrase.split(' ');

            function animateText(index = 0) {
                if (index < words.length) {
                    const span = document.createElement('span');
                    span.textContent = words[index];
                    span.className = 'inline-block opacity-0 animate-smooth-fade-in';
                    span.style.animationDelay = `${index * 0.1}s`;
                    animatedTextElement.appendChild(span);

                    // Add a space after each word (except the last one)
                    if (index < words.length - 1) {
                        animatedTextElement.appendChild(document.createTextNode(' '));
                    }
                }
                if (index < words.length - 1) {
                    setTimeout(() => animateText(index + 1), 100);
                }
            }

            function updateCountdown() {
                countdownElement.textContent = timeLeft;

                if (timeLeft === 0) {
                    clearInterval(countdownTimer);
                    startDownload();
                } else {
                    timeLeft--;
                }
            }

            function startDownload() {
                downloadFrame.src = "{{ $download->link }}";
                downloadStatus.classList.remove('hidden');
                downloadButton.classList.remove('hidden');
            }

            animateText();
            const countdownTimer = setInterval(updateCountdown, 1000);
        });
    </script>
@endsection
