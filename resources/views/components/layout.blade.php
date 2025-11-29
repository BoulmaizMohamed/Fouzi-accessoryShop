<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? 'King Auto - Votre spécialiste en Accessoires automobiles pour Peugeot, Renault, Citroën et Dacia' }}">
    <title>{{ $title ?? 'King Auto - Accessoires automobiles automobiles' }}</title>

    {{-- Fonts & Styles --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{ $styles ?? '' }}
</head>
<body>
    <x-header />

    <main class="main-content">
        {{ $slot }}
    </main>

    <x-footer />

    <script src="{{ asset('js/app.js') }}"></script>
    {{ $scripts ?? '' }}
</body>
</html>