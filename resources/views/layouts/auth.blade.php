<html>
    <head>
        <title>LifebookApp - @yield('title')</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

        <link rel='stylesheet' href='/public/assets/css/style.css'/>
        <link rel='stylesheet' href='/public/library/iconsax/style.css'/>
    </head>
    <body class='auth-page'>

        <div class='auth-illus-wrapper'>
            <div class='auth-illus-content'>
                <img/>
                <h2>Lorem Ipsum Dolor Sit Amet</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc scelerisque rutrum libero, sit amet maximus orci aliquam finibus. Vivamus hendrerit magna at commodo fermentum. Donec eget erat ultricies, rhoncus sem a, elementum justo.</p>
            </div>
        </div>

        <div class='auth-form-container'>
            @yield('auth-form')
        </div>

    </body>
</html>
