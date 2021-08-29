<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_name')->nullable(false)->after('id');
            $table->string('language')->nullable()->after('email');
            $table->string('school')->nullable();
            $table->date('birthday')->nullable(false);
            $table->string('edu_org')->nullable();
            $table->string('user_role')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_name');
            $table->dropColumn('language')->after('email');
            $table->dropColumn('school');
            $table->dropColumn('birthday');
            $table->dropColumn('edu_org');
            $table->dropColumn('user_role');
        });
    }
}
