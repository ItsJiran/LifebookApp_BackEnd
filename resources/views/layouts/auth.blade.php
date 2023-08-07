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

        <div class='layout-wrapper'>
            <div class='auth-illus-wrapper'>
                <div class='auth-illus-content'>
                    <img/>
                    <h2 class=''>Lorem Ipsum Dolor Sit Amet</h2>
                    <p class='label-3 medium dark-blue-1'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc scelerisque rutrum libero, sit amet maximus orci aliquam finibus. Vivamus hendrerit magna at commodo fermentum. Donec eget erat ultricies, rhoncus sem a, elementum justo.</p>
                </div>
            </div>

            <div class='auth-form-container flex-column flex-justify-center'>
                <div class='auth-form-top text-center mb-10'>
                    <img class='svg-icon logo filter-blue-2' src='/public/library/iconsax/bold/book-1.svg' />
                    <h1 class='head-3 blue-2 bold mb-20'>My Own Life Book Digital</h1>
                    <p class='label-4 regular dark-blue-2'>Masukkan data anda untuk masuk ke dalam aplikasi</p>
                </div>

                @yield('auth-form')
            </div>
        </div>

        <script src='/public/assets/js/script.functions.js?v={{ time() }}'></script>
        <script src='/public/assets/js/script.js?v={{ time() }}'></script>
    </body>
</html>
