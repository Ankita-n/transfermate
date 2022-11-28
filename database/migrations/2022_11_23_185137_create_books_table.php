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
        if(!Schema::hasTable('books')){
            Schema::create('books', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('author_id');
                $table->foreign('author_id')->references('id')->on('authors');
                $table->string('book_id',15)->nullable();
                $table->string('title',100)->nullable();
                $table->string('genre',15)->nullable();
                $table->decimal('price',10,2)->nullable();
                $table->date('publish_date')->nullable();
                $table->text('description')->nullable();
                $table->timestamps();
            });
        }
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
