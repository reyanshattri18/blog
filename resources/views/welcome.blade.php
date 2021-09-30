<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('css/app.css')}}">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        </style>
    </head>
    <body class="antialiased">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 xl:max-w-5xl xl:px-0">
            <main>
                <div class="divide-y divide-gray-200">
                    <div class="pt-6 pb-8 space-y-2 md:space-y-5">
                        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl md:text-[4rem] md:leading-[3.5rem]">Latest Posts</h1>
                        <p class="text-lg text-gray-500">All the latest CSS news, straight from the team.</p>
                    </div>

                    <ul class="divide-y divide-gray-200">
                        @include('posts.listing');
                    </ul>
                </div>
            </main>
        </div>
        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
        <script>
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('21aeda146007901334a1', {
                cluster: 'ap2'
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function(data) {
                alert('New Post Added...')
            });
        </script>
    </body>
</html>
