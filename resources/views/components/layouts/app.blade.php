<!doctype html>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" type="icon" href="{{url(asset('/imagen/favicon.ico'))}}" />
    <title>{{$title ?? 'Abarrotes Express'}}</title>
    @livewireStyles
    <link rel="stylesheet" href="{{url(asset('css/estilo/styles.css'))}}">
    <link rel="stylesheet" href="{{url(asset('css/custom.css'))}}">

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
</body>
@livewireScripts
<script src="{{url(asset('js/popper.min.js'))}}"></script>
<script src="{{url(asset('js/sweetalert2@11.js'))}}"></script>
<script src="{{url(asset('js/jquery-3.7.1.min.js'))}}"></script>
<script src="{{url(asset('js/slick.min.js'))}}"></script>
<script src="{{url(asset('/js/tailwind.js'))}}"></script>
<script src="{{url(asset('js/preline.js'))}}"></script>
<x-livewire-alert::scripts />

</html>

