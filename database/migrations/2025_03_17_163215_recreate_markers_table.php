<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('markers'); // ลบตารางเดิม

        Schema::create('markers', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('subdistrict')->nullable();
            $table->string('Nactivity')->nullable();
            $table->string('mauban')->nullable();
            $table->string('mautee')->nullable();
            $table->string('arear_money')->nullable();
            $table->date('time_pj')->nullable();
            $table->date('time_pj_end')->nullable();
            $table->string('year_money')->nullable();
            $table->text('description')->nullable();
            $table->text('suggestions')->nullable();
            $table->string('my_name')->nullable();
            $table->string('status')->nullable();
            $table->integer('number_target')->nullable();
            $table->integer('number_target_out')->nullable();
            $table->text('performancex')->nullable();
            $table->text('applied')->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('markers'); // ลบตารางถ้าต้อง rollback
    }
};

