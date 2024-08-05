<!doctype html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite('resources/js/app.js')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" type="icon" href="{{url(asset('/imagen/favicon.ico'))}}" />
    <title>{{$title ?? 'Abarrotes Express'}}</title>
    @livewireStyles
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">


    <script src="{{url(asset('/js/script.js'))}}"></script>
    <link rel="stylesheet" href="{{url(asset('/css/estilo/styles.css'))}}">
    <link rel="stylesheet" href="{{url(asset('/css/estilo/custom.css'))}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>
<body>
@livewire('complementos.navbar')
{{--Contenido--}}
<div>
    <div class="pt-16">
        <main>
            {{ $slot }}
        </main>
    </div>
</div>
@livewire('complementos.footer')
@livewireScripts
<script src="https://cdn.tailwindcss.com"></script>
<script src="{{url(asset('js/jquery-3.7.1.min.js'))}}"></script>
<script src="{{url(asset('js/slick.min.js'))}}"></script>
<script src="{{url(asset('js/popper.min.js'))}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
