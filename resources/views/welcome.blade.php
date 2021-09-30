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
                        <li class="py-12">
                        <article class="space-y-2 xl:grid xl:grid-cols-4 xl:space-y-0 xl:items-baseline">
                            <dl>
                                <dt class="sr-only">Published on</dt>
                                <dd class="text-base font-medium text-gray-500"><time datetime="2021-08-11T19:30:00.000Z">August 12, 2021</time></dd>
                            </dl>
                            <div class="space-y-5 xl:col-span-3">
                                <div class="space-y-6">
                                    <h2 class="text-2xl font-bold tracking-tight"><a class="text-gray-900" href="/tailwind-ui-ecommerce">Introducing Tailwind UI Ecommerce</a></h2>
                                    <div class="prose max-w-none text-gray-500">
                                        <div class="prose max-w-none">
                                        <p>Almost 6 months in the making, we finally released <a href="https://tailwindui.com/#product-ecommerce">Tailwind UI Ecommerce</a> — the first all-new component kit for Tailwind UI since the initial launch back in February 2020.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-base font-medium"><a class="text-teal-600 hover:text-teal-700" aria-label="Read &quot;Introducing Tailwind UI Ecommerce&quot;" href="/tailwind-ui-ecommerce">Read more →</a></div>
                            </div>
                            </article>
                        </li>
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
