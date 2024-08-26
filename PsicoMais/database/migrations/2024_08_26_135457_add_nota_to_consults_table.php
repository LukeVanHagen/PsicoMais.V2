<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotaToConsultsTable extends Migration
{
    public function up()
    {
        Schema::table('consults', function (Blueprint $table) {
            $table->string('nota')->nullable();
        });
    }

    public function down()
    {
        Schema::table('consults', function (Blueprint $table) {
            $table->dropColumn('nota');
        });
    }
}
