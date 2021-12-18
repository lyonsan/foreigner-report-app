<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsRelationUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('relation_users', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('report_id')->nullable()->index();
            $table->foreign('report_id')->references('id')->on('reports');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('relation_users', function (Blueprint $table) {
            $table->dropForeign('relation_users_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('relation_users_report_id_foreign');
            $table->dropColumn('report_id');
        });
    }
}
