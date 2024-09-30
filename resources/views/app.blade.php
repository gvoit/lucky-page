<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
      
        @inertiaHead
        @routes
        @vite(['resources/js/app.js', "resources/js/pages/{$page['component']}.vue"])
       
    </head>
    <body>
        @inertia
    </body>
</html>