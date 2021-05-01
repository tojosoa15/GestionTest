<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFormPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_pages',function(Blueprint $table){
            $table->increments('id_form_page');
            $table->integer('form_id')->unsigned();
            $table->text('name_form_page');
            $table->foreign('form_id','form_page_has_form_id')->references('id_form')->on('forms')->onDelete('cascade');
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
        Schema::drop('form_pages');
    }
}
