<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Lending;
use Illuminate\Support\Facades\Mail;
use App\Mail\FineNotification;

class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications to users with fines';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Retrieve loans with calculated fines, pending status, and late_fine > 0
        $loansWithFines = Lending::where('return_status', 'pending')
            ->where('late_fine', '>', 0)
            ->get();

        foreach ($loansWithFines as $loan) {
            $user = $loan->user;

            if ($user) {
                // Compose and send email notification using the FineNotification Mailable
                Mail::to($user->email)->send(new FineNotification($loan));
            }
        }
    }
}
