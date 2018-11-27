<?php

namespace App\Http\Controllers;

use App\GoogleScholar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    public function normal(Request $request, $s)
    {
      $cacheKey = json_encode($request->all());

      if ($request->search) {
          return redirect('/' . $request->qUrl);
      }

      $scihubUrl = config('services.scihub.url');
      if ($s == 's') {
        $sciHub = true;
      } else {
        $sciHub = false;
      }

      if ($request->has('doi')) {
        if (! Cache::has($cacheKey)) {
          Cache::forever($cacheKey, $request->doi);
        }
        
        if ($sciHub) {
            return redirect()->away($scihubUrl . '/' . $request->doi);
        }

        return view('results.doi', compact('doi', 'scihubUrl'));
      }

        /**
         * First see if we have a Cache  
         * Before searching Google Scholar 
         */
        if (Cache::has($cacheKey)) {
          $doi = Cache::get($cacheKey);
          
          if ($sciHub) {
            return redirect()->away($scihubUrl . '/' . $doi);
          }

          return view('results.doi', compact('doi', 'scihubUrl'));
        }

        /**
         * No DOI, no Cache 
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
