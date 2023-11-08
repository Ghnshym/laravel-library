<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Lending;
use App\Models\Notification;
use Carbon\Carbon;

class CalculateFines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:fines';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate fines for overdue books';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Retrieve overdue loans with a pending return status
        $overdueLoans = Lending::where('due_date', '<', Carbon::now())
            ->where('return_status', 'pending')
            ->whereNotNull('returned_at')
            ->get();

        foreach ($overdueLoans as $loan) {
            $returnedAt = Carbon::parse($loan->returned_at);

            $daysOverdue = $returnedAt->diffInDays(Carbon::now()); // Calculate overdue days from returned_at to current date
            $fine = $daysOverdue * 10; // Assuming a fine of 10 units per day

            if ($fine > 0) {
                // Update the late_fine column for the loan
                $loan->update(['late_fine' => $fine]);
            }

            // Insert notification details into the notifications table
            Notification::create([
                'user_id' => $loan->user_id,
                'book_id' => $loan->book_id,
                'late_fine' => $fine,
                'returned_at' => $loan->returned_at,
                'message' => 'Your book is overdue, and a fine has been calculated.',
            ]);
        }
    }
}
