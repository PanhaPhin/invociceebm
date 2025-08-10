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
        Schema::table('invoices', function (Blueprint $table) {
            // Add the exchange_rate column
            $table->decimal('exchange_rate', 10, 4)->after('last_recurring_on')->nullable(); // Or ->default(0.0000) or remove nullable if you always have a rate
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            // Drop the exchange_rate column if the migration is rolled back
            $table->dropColumn('exchange_rate');
        });
    }
};