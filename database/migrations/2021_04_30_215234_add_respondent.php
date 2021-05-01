<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRespondent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respondents',function(Blueprint $table){
            $table->increments('id_respondent');
            $table->integer('form_id')->unsigned();
            $table->foreign('form_id','respondent_has_form_id')->references('id_form')->on('forms')->onDelete('cascade');
            $table->boolean('statut_respond');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('respondents');
    }
}
