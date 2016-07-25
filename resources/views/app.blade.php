<html>
    <head>
        <meta charset="UTF-8">
        <title>About</title>
        <link rel="stylesheet" href="/laravel-02/public/css/all.css">

        <script src="/laravel-02/public/js/all.js"></script>
    </head>
    
    <body>
        @include('partials.nav')
        <div class='container'>
            @include('flash::message')
            
            @yield('content') 
        </div>
            
        @yield('footer')
        
        
        <script>
            $('div.alert').not('.alert_important').delay(3000).slideUp(300);
        </script>
    </body>
</html>

