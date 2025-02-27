<html>
    <head>
        <title>LifebookApp - @yield('title')</title>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'/>

	<link rel='icon' type='image/x-icon' href='/public/favicon.ico'/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

        <link rel='stylesheet' type='text/css' href='/public/assets/css/reset.css'/>
        <link rel='stylesheet' type='text/css' href='/public/assets/css/style.css?v={{ time() }}'/>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js'></script>

        <meta id='csrf-token' name='csrf-token' content='{{ csrf_token() }}'/>
        @yield('head-content')
    </head>
    <body class='home-page'>

        <div id='notification-wrapper' class='notification-wrapper'>
          <div id='notification-container' class='notification-container'>
            <div class='notification-loading-container'>
              <label class='blue-2 label-4 semibold'>Loading..</label>
            </div>
            <div class='notification-message-container'>
            </div>
          </div> 
        </div>

        <div class='layout-wrapper'>
            <div class='layout-main'>
                @yield('layout-main-header')
                @yield('layout-main-content')
            </div>

            <div class='layout-nav flex-center-between shadow-2'>
                <div class='nav-menu-container flex-center-between'>
                    @yield('nav-menu-content')
                </div>
            </div>
        </div>

        @yield('footer-script-content')
        <script src='/public/assets/js/script.functions.js?v={{ time() }}'></script>
        <script src='/public/assets/js/script.js?v={{ time() }}'></script>
    </body>
</html>
