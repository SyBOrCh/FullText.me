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
            <div class="jumbotron">
              <h1 class="display-4">Full Text Finder</h1>
              <p class="lead">Use this site to resolve links to the full text of the paper.</p>
              <p class="lead">To start, copy the url from &mdash; for example &mdash; WorldCat into the search bar and hit enter.</p>
              <hr class="my-4">
              <form class="form-inline" action="/search" method="GET">
                <input type="hidden" name="search" value="true">
                <input 
                    type="text" 
                    name="qUrl"
                    class="form-control form-control-lg mr-2" 
                    placeholder="https://vu.on.worldcat.org/atoztitles/link?aulast=...&title=...&volume=...&issue=...&coden=..." 
                    style="width: 80%;" 
                    autofocus 
                    required
                >    
                
                <button type="submit" class="btn btn-lg btn-outline-primary">Get Full Text</button>
              
              </form>
            </div>
        </div>
    </body>
</html>
