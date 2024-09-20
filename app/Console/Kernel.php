<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Services\KanyeQuoteService;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $quoteService = new KanyeQuoteService();
            try {
                $quotes = $quoteService->getRandomQuotes(5);
                // Here you can store the quotes in the database or cache if needed
                Log::info('Quotes updated successfully: ' . json_encode($quotes));
            } catch (\Exception $e) {
                Log::error('Failed to update quotes: ' . $e->getMessage());
                // Retry after 5 minutes
                $this->retryQuoteUpdate($quoteService);
            }
        })->hourly();
    }

    /**
     * Retry quote update after 5 minutes.
     */
    protected function retryQuoteUpdate(KanyeQuoteService $quoteService): void
    {
        $schedule = app(Schedule::class);
        $schedule->call(function () use ($quoteService) {
            try {
                $quotes = $quoteService->getRandomQuotes(5);
                // Store quotes in database or cache if needed
                Log::info('Quotes updated successfully on retry: ' . json_encode($quotes));
            } catch (\Exception $e) {
                Log::error('Failed to update quotes on retry: ' . $e->getMessage());
            }
        })->delay(now()->addMinutes(5));
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
