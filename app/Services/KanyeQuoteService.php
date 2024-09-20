<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class KanyeQuoteService
{
    private $apiUrl = 'https://api.kanye.rest/';

    public function getRandomQuotes($count = 5)
    {
        $quotes = [];
        for ($i = 0; $i < $count; $i++) {
            $response = Http::withoutVerifying()->get($this->apiUrl);
            if ($response->successful()) {
                $quotes[] = $response->json()['quote'];
            }
        }
        return $quotes;
    }
}