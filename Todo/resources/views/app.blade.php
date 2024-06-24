<!DOCTYPE html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @viteReactRefresh
        @vite(['resources/js/app.jsx', "resources/js/Pages/{$page['component']}.jsx"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia

        <script>
            (function () {
                const darkStyles = document.querySelector('style[data-theme="dark"]')?.textContent;
                const lightStyles = document.querySelector('style[data-theme="light"]')?.textContent;

                const removeStyles = () => {
                    document.querySelector('style[data-theme="dark"]')?.remove();
                    document.querySelector('style[data-theme="light"]')?.remove();
                };

                removeStyles();

                setDarkClass = () => {
                    removeStyles();

                    const isDark = localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);

                    isDark ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark');

                    if (isDark) {
                        document.head.insertAdjacentHTML('beforeend', `<style data-theme="dark">${darkStyles}</style>`);
                    } else {
                        document.head.insertAdjacentHTML('beforeend', `<style data-theme="light">${lightStyles}</style>`);
                    }
                };

                setDarkClass();

                window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', setDarkClass);
            })();
        </script>

    </body>
</html>
