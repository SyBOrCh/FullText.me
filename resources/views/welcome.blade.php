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
              <p class="lead">
                To start, copy the url from <em>worldcat</em> (for example) into the search bar and hit enter.
              </p>
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
              <div class="mt-5 text-center">
                <p >
                  Did you know you can prefix "{{ config('app.url') }}" to your worldcat url? You can use:
                  <br>
                  <span class="text-primary">{{ config('app.url') }}</span><span class="text-secondary">https://vu.on.worldcat.org/atoztitles/link?aulast=...&title=...&volume=...&issue=...&coden=...</span>
                </p>
                Bookmarklets (drag to bookmark bar): <br>
                 <a
                    onclick="(event) => { event.preventDefault(); console.log('test'); }"
                    class="btn btn-outline-secondary"
                    style="border-style: dotted; cursor: default"
                    href="javascript:(function(){ let links = document.querySelectorAll(&#x27;[data-tracking-action=&#x22;full text&#x22;]&#x27;); links.forEach(function (link) { link.href = &#x22;{{ config('app.url') }}/&#x22; + link.href; }); return alert(&#x27;Full Text - Ready to go&#x27;); })();"
                  >Reaxys FullText</a>
                 <a
                    onclick="preventDefault();"
                    class="btn btn-outline-secondary"
                    style="border-style:dotted; cursor: default;"
                    href="javascript:(function(){ let links = document.querySelectorAll(&#x27;[data-tracking-action=&#x22;full text&#x22;]&#x27;); links.forEach(function (link) { link.href = &#x22;{{ config('app.url') }}/s/&#x22; + link.href; }); return alert(&#x27;Full Text - Ready to go&#x27;); })();"
                  >Reaxys FullText (SciHub)</a>
              </div>
            </div>
        </div>
    </body>
</html>
