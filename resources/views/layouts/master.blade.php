<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Project 4 for CSCI E-15 Dynamic Web Applications">
        <meta name="author" content="Hisham Elhaggaz">

        <title>Careers Portal</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <!-- Fonts -->
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>

        <!-- Custom styles -->
        <link href='/css/main.css' type='text/css' rel='stylesheet'>

        <!-- Chosen Plugin -->
        <link href='/plugin/chosen/chosen.css' type='text/css' rel='stylesheet'>
        <script src='/plugin/chosen/chosen.jquery.js'></script>

       <h1> Careers <h1>

    </head>
    <body>

        @include('layouts.navigation')

        @yield('content')
        <footer>
            @if(session('alert'))
                <div class='alert'>
                    {{ session('alert') }}
                </div>
            @endif
            <!-- Initialize Chosen plugin: -->
            <script type="text/javascript">
                $(".chosen-select").chosen({
                  no_results_text: 'Oops, nothing found!',
                });
            </script>

            <div id='copyright'>© Copyright 2017 Hisham Elhaggaz</div>
        </footer>
    </body>
</html>
