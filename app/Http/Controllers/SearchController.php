<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function store(Request $request)
    {
        if ($request->search) {
          return redirect('/' . $request->qUrl);
        }

        if ($request->has('doi')) {
          $doi = $request->doi;
          $scihubUrl = config('services.scihub.url');
          
          return view('results.doi', compact('doi', 'scihubUrl'));
        }

        return 'no results';

        // The link does not have a DOI parameter 
        // Let's try Google Scholar search

        $googleScholar = new GoogleScholar($author = $request->aulast, $title = $request->title, $date = $request->date);

        // $googleUrl = "https://scholar.google.com/scholar?as_q=&as_epq=&as_oq=&as_eq=&as_occt=any&as_sauthors={$lastAuthor}&as_publication={$title}&as_ylo={$date}&as_yhi={$date}";

        // $searchResult = file_get_contents(htmlspecialchars_decode($googleUrl, ENT_QUOTES));

        // $regex = '/<h3\s*class="gs_rt">\s*<a\s+(?:[^>]*?\s+)?href="([^"]*)"/';

        // preg_match($regex, $searchResult, $match);

        // dd($match[1]);
    }
}
