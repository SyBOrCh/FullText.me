<?php

namespace App\Http\Controllers;

use App\GoogleScholar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    public function normal(Request $request, $s)
    {
      $cacheKey = json_encode($request->query->all());

      $sciHub = false;

        if ($s == 's') {
          $sciHub = true;
        }

        $scihubUrl = config('services.scihub.url');

        if ($request->search) {
          return redirect('/' . $request->qUrl);
        }

        /**
         * Cache  
         * Do we already have this URL in the cache?
         */
        if (Cache::has($cacheKey)) {
          $doi = Cache::get($cacheKey);

          session()->flash('message', 'Resolved from cache');
          
          if ($sciHub) {
            return redirect()->away($scihubUrl . '/' . $doi);
          }

          return view('results.doi', compact('doi', 'scihubUrl'));
        }

        if ($request->has('doi')) {
          $doi = $request->doi;
          // Store the found DOI in the Cache 
          Cache::forever($cacheKey, $doi);
          
          if ($sciHub) {
            return redirect()->away($scihubUrl . '/' . $doi);
          }

          return view('results.doi', compact('doi', 'scihubUrl'));
        }

        /**
         * The link does not contain a DOI parameter
         * Let's try Google Scholar
         */
        $googleScholar = new GoogleScholar($author = $request->aulast, $title = $request->title, $date = $request->date);
        
        if ($googleScholar->search()->hasResults()) {
          $doi = $googleScholar->doi;
          // Store the found DOI in the Cache 
          Cache::forever($cacheKey, $doi);
          
          if ($sciHub) {
            return redirect()->away($scihubUrl . '/' . $doi);
          }

          return view('results.doi', compact('doi', 'scihubUrl'));
        }

        return redirect()->away("https://www.google.com/?q={$request->title}%20{$request->aulast}%20{$request->date}");
    }
}
