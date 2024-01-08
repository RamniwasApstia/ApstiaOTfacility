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
        Schema::create('ot_time', function (Blueprint $table) {
            $table->id('time_id');
            $table->integer('ot_id');
            $table->integer('day');
            $table->string('from');
            $table->string('to');
            $table->enum('status', [0, 1])->default('0')->comment('0=Active, 1=Inactive');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ot_time');
    }
};
