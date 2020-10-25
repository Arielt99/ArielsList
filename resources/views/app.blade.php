<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
<style>
    /* width */
::-webkit-scrollbar {
  background: rgb(241, 241, 241);
  width: 5px;
}
/* Track */
::-webkit-scrollbar-track {
  border-radius: 2px;
  background: rgb(241, 241, 241);
}
/* Handle */
::-webkit-scrollbar-thumb {
  background: rgb(48, 48, 48);
  border-radius: 2px;
}
</style>
