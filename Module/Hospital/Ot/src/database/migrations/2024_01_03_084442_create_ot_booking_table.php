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
        Schema::create('ot_booking', function (Blueprint $table) {
            $table->id();
            $table->string('ot_number');
            $table->string('ot_price');
            $table->string('doctor');
            $table->string('requested_by');
            $table->string('patient');
            $table->date('booking_date');
            $table->date('booking_time');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ot_booking');
    }
};
