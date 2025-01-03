<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pomodoro</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/eye-tracking.js'])
    @else
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/eye-tracking.js') }}"></script>
    @endif
    @livewireStyles
</head>

<body id="body" class="bg-primaryBlue font-sans flex flex-col items-center justify-center h-screen">
    <div>
        <button class="absolute top-4 right-4 text-white focus:outline-none" onclick="toggleSideBar()">
            <svg id="toggle-icon" class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path id="toggle-icon-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>

        <div id="sidebar" class="fixed top-0 right-0 h-full w-2/5 bg-sideBar shadow-lg transform translate-x-full transition-transform duration-300 overflow-y-auto">
            <div class="p-6">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-3xl font-bold text-center">FocusFriend.io</h2>
                    <button class="text-amber-700 text-4xl font-bold" onclick="toggleSideBar()">X</button>
                </div>

                <div class="flex items-center justify-between mb-8">
                    <span class="text-lg font-bold">Focus Points:</span>
                    <span class="text-xl font-bold">0</span>
                </div>

                @livewire('background-changer')

                <div class="mb-8">
                    <h3 class="text-xl font-bold mb-4">Settings</h3>
                    <div class="flex items-center mb-4">
                        <input type="radio" name="settings" id="standard" class="mr-2">
                        <label for="standard" class="text-lg font-medium">Standard</label>
                    </div>
                    <div class="flex items-center mb-4">
                        <input type="radio" name="settings" id="custom" class="mr-2">
                        <label for="custom" class="text-lg font-medium">Custom</label>
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-lg">Auto Start Focus</span>
                        <input type="checkbox" class="toggle">
                    </div>
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-lg">Auto Start Breaks</span>
                        <input type="checkbox" class="toggle">
                    </div>
                </div>

                <div class="text-center">
                    <button class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600">
                        Report Bug
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col items-center justify-center mb-10">
        <div class="flex">
            <div class="size-24 -m-2 bg-white rounded-full flex items-center justify-center relative overflow-hidden">
                <img id="eye-left" src="{{ asset('images/03_pupil.svg') }}" class="size-9 absolute" onclick="changeEyeImage()">
            </div>
            <div class="size-24 -m-2 bg-white rounded-full flex items-center justify-center relative overflow-hidden">
                <img id="eye-right" src="{{ asset('images/03_pupil.svg') }}" class="size-9 absolute" onclick="changeEyeImage()">
            </div>
        </div>
        <div class="relative w-48 h-7 mt-4">
            <div class="absolute inset-0 w-full h-full border-white border-8 border-opacity-35 rounded-full"></div>
            <div class="w-44 absolute inset-0 h-3 bg-black rounded-full m-auto"></div>
        </div>
    </div>

    @livewire('pomodoro-timer')

    <script>
        function toggleSideBar() {
            const sidebar = document.getElementById("sidebar");
            const toggleIconPath = document.getElementById("toggle-icon-path");

            if (sidebar.classList.contains("translate-x-full")) {
                sidebar.classList.remove("translate-x-full");
                toggleIconPath.setAttribute("d", "M6 18L18 6M6 6l12 12");
            } else {
                sidebar.classList.add("translate-x-full");
                toggleIconPath.setAttribute("d", "M4 6h16M4 12h16m-7 6h7");
            }
        }

        const eyeImages = [
            '{{ asset("images/01_pupil.svg") }}',
            '{{ asset("images/03_pupil.svg") }}',
            '{{ asset("images/04_pupil.svg") }}',
            '{{ asset("images/05_pupil.svg") }}',
            '{{ asset("images/06_pupil.svg") }}',
        ];

        function changeEyeImage() {
            const leftEye = document.getElementById("eye-left");
            const rightEye = document.getElementById("eye-right");

            let currentIndex = eyeImages.indexOf(leftEye.src);

            if (currentIndex === -1) {
                currentIndex = 1;
            }

            const nextIndex = (currentIndex + 1) % eyeImages.length;

            leftEye.src = eyeImages[nextIndex];
            rightEye.src = eyeImages[nextIndex];
        }

        document.addEventListener('livewire:init', () => {
            Livewire.on('changeBackgroundColor', (event) => {
                const bgColor = event[0].bgColor; 
                document.getElementById('body').className = `${bgColor} font-sans flex flex-col items-center justify-center h-screen`;
            });
        });
    </script>

    @livewireScripts
</body>

</html>