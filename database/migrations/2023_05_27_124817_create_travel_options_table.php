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
        Schema::create('travel_options', function (Blueprint $table) {
            $table->id();
            $table->morphs('travellable');
            $table->decimal('price', $precision = 8, $scale = 2);
            $table->foreignId('location_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_options');
    }
};
