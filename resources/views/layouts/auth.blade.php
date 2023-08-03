<html>
    <head>
        <title>LifebookApp - @yield('title')</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'/>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

        <link rel='stylesheet' type='text/css' href='/public/assets/css/reset.css'/>
        <link rel='stylesheet' type='text/css' href='/public/assets/css/style.css?v={{ time() }}'/>
    </head>
    <body class='auth-page'>

        <div class='auth-illus-wrapper'>
            <div class='auth-illus-content'>
                <img/>
                <h2>Lorem Ipsum Dolor Sit Amet</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc scelerisque rutrum libero, sit amet maximus orci aliquam finibus. Vivamus hendrerit magna at commodo fermentum. Donec eget erat ultricies, rhoncus sem a, elementum justo.</p>
            </div>
        </div>

        <div class='auth-form-container flex-column flex-justify-center'>
            @yield('auth-form')
        </div>

    </body>
</html>
