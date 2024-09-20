<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\KanyeQuoteService;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    private $quoteService;

    public function __construct(KanyeQuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
    }

    public function getQuotes(Request $request, $count = 5)
    {
        if (!$request->user()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $count = min(max(1, intval($count)), 50); // Ensure count is between 1 and 50
        $quotes = $this->quoteService->getRandomQuotes($count);
        return response()->json(['quotes' => $quotes]);
    }
}