<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
        });
        DB::table('tag_types')->insert(['title' => 'Skills', ]);
        DB::table('tag_types')->insert(['title' => 'Interests', ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_types');
    }
}
