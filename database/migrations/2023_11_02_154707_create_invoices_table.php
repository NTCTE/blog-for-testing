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
        Schema::create('invoices', function (Blueprint $table) {
            $table -> id();
            $table -> unsignedBigInteger('amount');
            $table -> foreignId('user_id')
                -> references('id')
                -> on('users');
            $table -> uuid('bank_uuid')
                -> unique();
            $table -> enum('status', [
                'payment',
                'paid',
                'error',
                'refund',
            ]);
            $table -> jsonb('cart')
                -> nullable();
            $table -> morphs('payable');
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
