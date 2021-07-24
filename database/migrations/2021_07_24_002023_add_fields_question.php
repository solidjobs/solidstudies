<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsQuestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->unsignedInteger('subject_id');
            $table->string('question_text', 255);
            $table->text('question_html');
            $table->text('responses');
            $table->integer('correct_response');
            $table->text('explanation_html');
            $table->integer('tries');
            $table->integer('success');
            $table->integer('ratio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->removeColumn('subject_id');
            $table->removeColumn('question_text');
            $table->removeColumn('question_html');
            $table->removeColumn('responses');
            $table->removeColumn('correct_response');
            $table->removeColumn('explanation_html');
            $table->removeColumn('tries');
            $table->removeColumn('success');
            $table->removeColumn('ratio');
        });
    }
}
