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
        Schema::table('saving_goals', function (Blueprint $table) {
            Schema::dropIfExists('saving_goals'); // Drop the saving_goals table if it exists

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('saving_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('name');
            $table->integer('target_amount');
            $table->date('target_date');
            $table->enum('status', ['active', 'completed'])->default('active');
            $table->text('description')->nullable(); // Recreate the description column if needed
            $table->timestamps();
        });
    }
};
