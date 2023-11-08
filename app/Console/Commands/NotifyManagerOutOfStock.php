<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Book;
use Illuminate\Support\Facades\Mail;


class NotifyManagerOutOfStock extends Command
{
    protected $signature = 'notify:manager-out-of-stock';
    protected $description = 'Send email notification to the manager for out of stock books';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Check for out of stock books
        $outOfStockBooks = Book::where('quantity', 0)->get();

        if ($outOfStockBooks->count() > 0) {
            // Send email notification to the manager
            $managerEmail = 'manager@yopmail.com'; // Replace with the manager's email address
            $data = ['outOfStockBooks' => $outOfStockBooks];

            Mail::send('emails.out_of_stock_notification', $data, function ($message) use ($managerEmail) {
                $message->to($managerEmail)->subject('Out of Stock Books Notification');
            });
        }
    }
}