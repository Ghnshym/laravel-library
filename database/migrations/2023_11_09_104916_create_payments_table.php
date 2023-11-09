<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('payment_id');
            $table->string('entity');
            $table->decimal('amount', 10, 2);
            $table->string('currency');
            $table->unsignedBigInteger('lending_id');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('lending_id')->references('id')->on('lendings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
