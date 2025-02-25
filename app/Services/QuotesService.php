<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class QuotesService
{
    public function getQuotesData($amt)
    {
        //   hit the api get full list of quotes, store  in db cache for 1 hour
        $apiresponse = Cache::remember('quotes', 3600 , function () {
            $data = Http::get('https://raw.githubusercontent.com/ajzbc/kanye.rest/refs/heads/master/src/quotes.json');
            return $data->json();
        });
         // use cached response to create collection and get $amt of random entries
        // tested with debugbar, cache works
        return collect($apiresponse)->random($amt)->all();
    
    }
}

