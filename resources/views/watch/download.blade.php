@extends('layouts.app')

@section('meta')
    <meta name="description" content="Download your favorite content securely and quickly. Your loot awaits!">
@endsection

@section('content')
    <div x-data="downloadPage" class="relative overflow-hidden min-h-full .bg-blue-50 dark:bg-gray-950">
        <div class="text-gray-800 dark:text-white max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-24 relative">
            <div class="absolute inset-0 z-0">
                <img src="{{ $listing->coverurl }}" alt="{{ $listing->title }} cover"
                    class="absolute h-full w-full object-cover">
                <div
                    class="absolute inset-0 before:absolute before:right-0 before:top-0 before:bottom-0 before:w-1/4 before:bg-gradient-to-l before:from-blue-50 dark:before:from-gray-950 before:via-blue-50/70 dark:before:via-gray-950/70 before:to-transparent after:absolute after:left-0 after:top-0 after:bottom-0 after:w-1/4 after:bg-gradient-to-r after:from-blue-50 dark:after:from-gray-950 before:via-blue-50/70 dark:before:via-gray-950/70 after:to-transparent z-10">
                </div>
                <div
                    class="absolute inset-0 before:absolute before:inset-0 before:bg-gradient-to-b before:from-blue-50 dark:before:from-gray-950 before:via-blue-50/30 dark:before:via-gray-950/30 before:to-transparent before:z-10 after:absolute after:inset-0 after:bg-gradient-to-t after:from-blue-50 dark:after:from-gray-950 after:via-blue-50/30 dark:after:via-gray-950/30 after:to-transparent after:z-10">
                </div>
                <div class="absolute inset-0 .bg-blue-50/40 dark:bg-gray-950/40 z-10"></div>
            </div>
            <div class="relative z-20 text-center">
                <h1 class="text-3xl tracking-tighter font-semibold line-clamp-1 hidden lg:block">Downloading:
                    {{ $listing->title }}</h1>
                <p class="mt-3 text-gray-900 dark:text-gray-300">Your loot will start downloading in <span
                        x-text="countdown"></span> seconds —
                    brace yourself!</p>
                <div x-show="showStatus" x-cloak class="mt-4 text-green-600 dark:text-green-400 font-semibold">
                    Your loot is downloading! If it doesn't start automatically, hit the button below.
                </div>
                <div x-show="showButton" x-cloak class="mt-10">
                    <a href="{{ $download->link }}"
                        class="bg-primary-500 hover:bg-[#0881b6] text-white font-bold py-2 px-4 rounded" target="_blank">
                        Download Now
                    </a>
                </div>

                <iframe x-ref="downloadFrame" class="hidden"></iframe>
            </div>
            <p x-ref="animatedText" class="text-gray-900 dark:text-gray-300 text-center mt-10 mb-20"></p>
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }

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
        document.addEventListener('alpine:init', () => {
            Alpine.data('downloadPage', () => ({
                countdown: 5,
                showStatus: false,
                showButton: false,
                phrases: [
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
                ],
                init() {
                    this.startCountdown();
                    this.animateText();
                },
                startCountdown() {
                    const timer = setInterval(() => {
                        this.countdown--;
                        if (this.countdown === 0) {
                            clearInterval(timer);
                            this.startDownload();
                        }
                    }, 1000);
                },
                startDownload() {
                    this.$refs.downloadFrame.src = "{{ $download->link }}";
                    this.showStatus = true;
                    this.showButton = true;
                },
                animateText() {
                    const randomPhrase = this.phrases[Math.floor(Math.random() * this.phrases.length)];
                    const words = randomPhrase.split(' ');
                    const animatedTextElement = this.$refs.animatedText;

                    function addWord(index) {
                        if (index < words.length) {
                            const span = document.createElement('span');
                            span.textContent = words[index];
                            span.className = 'inline-block opacity-0 animate-smooth-fade-in';
                            span.style.animationDelay = `${index * 0.1}s`;
                            animatedTextElement.appendChild(span);

                            if (index < words.length - 1) {
                                animatedTextElement.appendChild(document.createTextNode(' '));
                            }

                            setTimeout(() => addWord(index + 1), 100);
                        }
                    }

                    addWord(0);
                }
            }))
        })
    </script>
@endsection
