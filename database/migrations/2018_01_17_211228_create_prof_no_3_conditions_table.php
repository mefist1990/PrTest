<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfNo3ConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
                        Schema::create('prof_no_3_conditions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('prof_id');
            $table->string('prof_title');
            $table->string('rating');
            $table->string('theme_num');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prof_no_3_conditions');
    }
}
