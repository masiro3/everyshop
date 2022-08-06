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
                $table->foreign('publisher_id')->references('id')->on('publishers'); 
                $table->timestamps();

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
