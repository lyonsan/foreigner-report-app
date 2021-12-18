<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTextInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_text_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('report_id')->nullable()->index();
            $table->foreign('report_id')->references('id')->on('reports');
            $table->unsignedBigInteger('text_id')->nullable()->index();
            $table->foreign('text_id')->references('id')->on('text_infos');
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
        Schema::dropIfExists('report_text_infos');
    }
}
