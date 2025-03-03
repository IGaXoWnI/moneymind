<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsFixedAndNextDateToExpensesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->enum('is_fixed', ['yes', 'no'])->default('no'); // Add is_fixed column
            $table->date('next_date')->nullable(); // Add next_date column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropColumn('is_fixed'); // Drop is_fixed column
            $table->dropColumn('next_date'); // Drop next_date column
        });
    }
}