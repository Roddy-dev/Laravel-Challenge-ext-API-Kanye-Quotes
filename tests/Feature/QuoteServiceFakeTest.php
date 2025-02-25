<?php

use App\Services\QuotesService;

use Illuminate\Support\Facades\Http;

test('the api external call returns a fake response', function () {
    Http::fake([
        'https://raw.githubusercontent.com/ajzbc/*' => Http::response([
            '01' => 'quote 1',
            '02' => 'quote 2',
            '03' => 'quote 3',
            '04' => 'quote 4',
            '05' => 'quote 5',
            '06' => 'quote 6',
        ], 200),
    ]);

    // Instantiate the WeatherService class
    $quotesService = new QuotesService();

    // Call the getQuoteService method asking for 3 quotes
    $response = $quotesService->getQuotesData(3);

    // Assertions

    expect($response)->not->toBeEmpty();
    expect($response)->tobeArray();
    expect($response)->tohaveCount(3);
    expect($response[0])->toContain('quote');
    expect($response[1])->toBeIn([
        '01' => 'quote 1',
        '02' => 'quote 2',
        '03' => 'quote 3',
        '04' => 'quote 4',
        '05' => 'quote 5',
        '06' => 'quote 6',
    ]);

});
