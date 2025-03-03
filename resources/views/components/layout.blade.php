<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">

    <link rel="manifest" href="{{ asset('manifest.json') }}">

    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>DermaScan</title>
</head>

<body>
    <div class="min-h-auto flex flex-col">
        {{ $slot }}
    </div>

    {{-- handling darkmode --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const themeToggle = document.getElementById("theme-toggle");
            const themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");
            const themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");

            // Cek apakah ada preferensi dark mode yang tersimpan di localStorage
            if (localStorage.getItem("theme") === "dark" ||
                (!localStorage.getItem("theme") && window.matchMedia("(prefers-color-scheme: dark)").matches)) {
                document.documentElement.classList.add("dark");
                themeToggleDarkIcon.classList.remove("hidden");
                themeToggleLightIcon.classList.add("hidden");
            } else {
                document.documentElement.classList.remove("dark");
                themeToggleLightIcon.classList.remove("hidden");
                themeToggleDarkIcon.classList.add("hidden");
            }

            // Event listener untuk toggle dark mode
            themeToggle.addEventListener("click", function() {
                if (document.documentElement.classList.contains("dark")) {
                    document.documentElement.classList.remove("dark");
                    localStorage.setItem("theme", "light");
                    themeToggleLightIcon.classList.remove("hidden");
                    themeToggleDarkIcon.classList.add("hidden");
                } else {
                    document.documentElement.classList.add("dark");
                    localStorage.setItem("theme", "dark");
                    themeToggleDarkIcon.classList.remove("hidden");
                    themeToggleLightIcon.classList.add("hidden");
                }
            });
        });
    </script>
</body>

</html>
