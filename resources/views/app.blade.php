<html>
    <head>
        <meta charset="UTF-8">
        <title>About</title>
        <link rel="stylesheet" href="../css/all.css">

        <script src="../js/all.js"></script>
    </head>
    
    <body>
        <div class='containter' style='margin: 10px;'>
            @include('flash::message')
            
            @yield('content') 
        </div>
            
        @yield('footer')
        
        
        <script>
            $('div.alert').not('.alert_important').delay(3000).slideUp(300);
        </script>
    </body>
</html>

