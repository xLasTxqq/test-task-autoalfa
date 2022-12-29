<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title inertia>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <!-- <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap"> -->


    <!-- Scripts -->
    <!-- <input class="hidden" id="ffdsfsdfdfsffsdf" hidden value="{{ auth()->check()?auth()->user()->jsPermissions():null }}">
    <script type="text/javascript">
        let roles = document.querySelector('#ffdsfsdfdfsffsdf').value
        console.log("{{ auth()->check()?auth()->user()->jsPermissions():null }}")
        console.log(roles)
        window.Laravel = {
            csrfToken: "{{ csrf_token() }}",
            jsPermissions: "{{ auth()->check()?auth()->user()->jsPermissions():null }}"
        }
    </script> -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead
    
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>