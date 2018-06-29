<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        {{-- Fonts --}}
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,700" rel="stylesheet">
    </head>

    <body id="top">

        <div class="site">

            @hasSection ('aside')
                <main class="site__main site__main--aside" role="main">
                    <section class="site__content">
                        @yield('content')
                    </section>

                    <aside class="site__aside">
                        @yield('aside')
                    </aside>
                </main>
            @else
                <main class="site__main site__main--full-width" role="main">
                    @yield('content')
                </main>
            @endif

        </div>

    </body>

</html>
