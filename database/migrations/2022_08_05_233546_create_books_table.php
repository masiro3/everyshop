<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->integer('stock');
                $table->integer('price');
                $table->unsignedBigInteger('publisher_id'); # 外部キー
                $table->unsignedBigInteger('category_id'); # 外部キー
                $table->bigInteger('user_id')->unsigned()->index();
                $table->foreign('publisher_id')->references('id')->on('publishers');
                $table->foreign('category_id')->references('id')->on('categories');
                $table->timestamps();
                $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
