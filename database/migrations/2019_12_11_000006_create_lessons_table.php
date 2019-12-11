<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title')->unique();

            $table->longText('decription')->nullable();

            $table->string('slug')->nullable();

            $table->boolean('active')->default(0)->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
