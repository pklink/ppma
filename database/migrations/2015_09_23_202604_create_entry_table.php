<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        Schema::create('entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            /** @noinspection PhpUndefinedMethodInspection */
            $table->string('url')->nullable();
            $table->binary('password');
            $table->timestamps();
            $table->index('label');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /** @noinspection PhpUndefinedMethodInspection */
        Schema::drop('entries');
    }
}
