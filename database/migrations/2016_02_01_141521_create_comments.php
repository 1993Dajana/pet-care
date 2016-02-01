<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function(Blueprint $table){
                    // Blueprint e klasa koja go sodrzi na nekoj nachin skeletot na shemata
                $table->increments('id'); // kolona id
                $table->integer('user_id')->unsigned()->default(0);;   // author_id - nadvoreshen kluch
                $table->foreign('user_id')
                      ->references('id')->on('users')       // so ova povrzuvas i kazuvas referenca na author_id e id-to na users tabelata
                      ->onDelete('cascade');                // so ova kazuvas ako go izbriseme user-ot od users tabelata, kaskadno da se izbrisat site negovi postovi (vo posts tabelata)
                $table->integer('post_id')->unsigned()->default(0);;
                $table->foreign('post_id')
                      ->references('id')->on('posts')
                      ->onDelete('cascade');
                $table->text('message');
                $table->timestamps();   // publishedon i last modifed e ova :D 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
