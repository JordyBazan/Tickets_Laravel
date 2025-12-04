<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'HPEP Panel') }}</title>

        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
        
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: {"50":"#eff6ff","100":"#dbeafe","200":"#bfdbfe","300":"#93c5fd","400":"#60a5fa","500":"#3b82f6","600":"#2563eb","700":"#1d4ed8","800":"#1e40af","900":"#1e3a8a"}
                        }
                    }
                }
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body class="bg-gray-50 font-sans antialiased">
        
        @include('layouts.navigation')

        <main class="p-4 sm:ml-64 mt-14 sm:mt-0">
            {{ $slot }}
        </main>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    </body>
</html>