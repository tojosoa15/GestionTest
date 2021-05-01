<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAnswerHasRespondant extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_has_respondents',function(Blueprint $table){
            $table->increments('id_answer_respondent');
            $table->integer('answer_id')->unsigned();
            $table->integer('respondent_id')->unsigned();
            $table->foreign('answer_id','answer_has_respondent_has_answer_id')->references('id_answer')->on('answers')->onDelete('cascade');
            $table->foreign('respondent_id','answer_has_respondent_has_respondent_id')->references('id_respondent')->on('respondents')->onDelete('cascade');
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
        Schema::drop('answer_has_respondents');
    }
}
