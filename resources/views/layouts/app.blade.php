<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Plataforma')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-zinc-900 text-zinc-200">
    <main>@yield('content')</main>
</body>

</html>
