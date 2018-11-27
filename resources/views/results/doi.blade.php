<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <title>{{ config('app.name') }}</title>
    </head>
    <body class="bg-purple">
        <div class="container">
            <div class="jumbotron text-center">
              <h1 class="display-4 text-primary">Gotcha!</h1>
              <p class="lead">We've found the article. How would you like to continue?</p>

              <a href="https://doi.org/{{ $doi }}" role="button" class="btn btn-primary btn-lg mr-4 mb-3">Open normally</a>
              <a href="{{ $scihubUrl }}/{{ $doi }}" role="button" class="btn btn-success btn-lg mb-3">Open with Sci-Hub</a>
            </div>
        </div>
    </body>
</html>
