<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_content', function (Blueprint $table) {
            $table->integer('report_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->text('subject');
            $table->integer('percentage');
            $table->enum('status', ['In Progress'=>1, 'Done'=>2])->comment="1 for in progress and 2 for done";
            $table->text('notes');
            $table->enum('label', ['Today'=>1, 'Tomorrow'=>2])->comment="1 for today and 2 for tomorrow";
            $table->foreign('project_id')->references('project_id')->on('project');
            $table->foreign('report_id')->references('report_id')->on('report');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('report_content');
    }
}
