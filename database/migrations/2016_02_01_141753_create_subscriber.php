<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriber extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribers', function(Blueprint $table){
                    // Blueprint e klasa koja go sodrzi na nekoj nachin skeletot na shemata
                $table->increments('id'); // kolona id
                $table->integer('user_id')->unsigned()->default(0);;   // author_id - nadvoreshen kluch
                $table->foreign('user_id')
                      ->references('id')->on('users')       
                      ->onDelete('cascade');                
                $table->integer('subscriber_id')->unsigned()->default(0);;
                $table->foreign('subscriber_id')
                      ->references('id')->on('users')
                      ->onDelete('cascade');
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
        Schema::drop('subscribers');
    }
}
