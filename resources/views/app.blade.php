<html>
    <head>
        <meta charset="UTF-8">
        <title>About</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    </head>
    
    <body>
        <div class='containter' style='margin: 10px;'>
            @include('flash::message')
            
            @yield('content') 
        </div>
        
        @yield('footer')
        
        <script src="//code.jquery.com/jquery.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        
        <script>
            $('div.alert').not('.alert_important').delay(3000).slideUp(300);
        </script>
    </body>
</html>
