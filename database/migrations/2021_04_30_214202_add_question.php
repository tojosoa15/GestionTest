<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions',function(Blueprint $table){
            $table->increments('id_question');
            $table->text('questionnaire');
            $table->integer('form_page_id')->unsigned();
            $table->integer('type_question_id')->unsigned();

            $table->foreign('form_page_id','question_has_form_page_id')->references('id_form_page')->on('form_pages')->onDelete('cascade');
            $table->foreign('type_question_id','question_has_type_question_id')->references('id_type_question')->on('type_questions')->onDelete('cascade');
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
        Schema::drop('questions');
    }
}
