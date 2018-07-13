<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>
        @section('head')
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <title>@yield('browser_title', config('app.name'))</title>

            <link rel="stylesheet" href="{{ mix('css/web.css') }}">
        @show
    </head>

    <body id="top">

        <div id="app" class="site">

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

        <script type="text/javascript" src="{{ mix('js/manifest.js') }}"></script>
        <script type="text/javascript" src="{{ mix('js/vendor.js') }}"></script>
        <script type="text/javascript" src="{{ mix('js/web.js') }}"></script>

    </body>

</html>
