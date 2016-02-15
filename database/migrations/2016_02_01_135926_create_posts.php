<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('posts', function(Blueprint $table){
                    // Blueprint e klasa koja go sodrzi na nekoj nachin skeletot na shemata
                $table->increments('id'); // kolona id
                $table->integer('user_id')->unsigned()->default(0);   // author_id - nadvoreshen kluch
                $table->foreign('user_id')
                      ->references('id')->on('users')       // so ova povrzuvas i kazuvas referenca na author_id e id-to na users tabelata
                      ->onDelete('cascade');                // so ova kazuvas ako go izbriseme user-ot od users tabelata, kaskadno da se izbrisat site negovi postovi (vo posts tabelata)
                $table->text('message');
                $table->string('address')->nullable();
                $table->timestamps();   // publishedon i last modifed e ova :D
                $table->float('longitude')->nullable();
                $table->float('latitude')->nullable();
                $table->string('post_picture');
                $table->enum('type',['found','lost','adopt', 'sell', 'injured'])->default('found');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("posts");
    }
}
