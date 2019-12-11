<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');

            $table->longText('description')->nullable();

            $table->string('slug')->nullable();

            $table->string('title');

            $table->date('start_date')->nullable();

            $table->boolean('published')->default(0)->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
