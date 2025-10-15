<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pj_person', function (Blueprint $table) {
            $table->id();
            $table->string('Nactivity');
            $table->string('name_lastname');
            $table->string('position');
            $table->timestamps();
        });

        Schema::create('pj_target', function (Blueprint $table) {
            $table->id();
            $table->string('Nactivity');
            $table->string('target');
            $table->timestamps();
        });

        Schema::create('pj_result', function (Blueprint $table) {
            $table->id();
            $table->string('Nactivity');
            $table->string('target');
            $table->timestamps();
        });

        Schema::create('pj_activity', function (Blueprint $table) {
            $table->id();
            $table->string('Nactivity');
            $table->string('name_activity');
            $table->string('person_pj');
            $table->string('resultx');
            $table->timestamps();
        });

        Schema::create('pj_maintarget', function (Blueprint $table) {
            $table->id();
            $table->string('Nactivity');
            $table->string('result_main');
            $table->string('goal_unit');
            $table->integer('goal_amount');
            $table->string('performance_unit');
            $table->integer('performance_amount');
            $table->timestamps();
        });

        Schema::create('pj_benefit', function (Blueprint $table) {
            $table->id();
            $table->string('Nactivity');
            $table->string('benefit');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pj_personj');
        Schema::dropIfExists('pj_target');
        Schema::dropIfExists('pj_result');
        Schema::dropIfExists('pj_activity');
        Schema::dropIfExists('pj_maintarget');
        Schema::dropIfExists('pj_benefit');
    }
};
