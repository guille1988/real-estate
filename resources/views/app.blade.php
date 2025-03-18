<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{config('app.name', 'Real state')}}</title>
        <link type="image/png" rel="icon" href="https://i.pinimg.com/474x/54/8f/62/548f6257b8cb05224075b138c76f86c7.jpg">

        @routes
        @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body>
        @inertia
    </body>
</html>
