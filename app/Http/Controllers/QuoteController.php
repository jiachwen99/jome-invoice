<?php

namespace App\Http\Controllers;

use App\Services\KanyeQuoteService;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    private $quoteService;

    public function __construct(KanyeQuoteService $quoteService)
    {
        $this->middleware('auth');
        $this->quoteService = $quoteService;
    }

    public function index()
    {
        $quotes = $this->quoteService->getRandomQuotes(5);
        return view('quotes', compact('quotes'));
    }

    public function refresh()
    {
        $quotes = $this->quoteService->getRandomQuotes(5);
        return redirect()->route('quotes')->with('quotes', $quotes);
    }
}