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
        Schema::create('detail_activity', function (Blueprint $table) {
            $table->id();
            $table->string('Nactivity');
            $table->string('detail_activity');
            $table->string('detail_x');
            $table->string('resultx');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_activity');
    }
};
