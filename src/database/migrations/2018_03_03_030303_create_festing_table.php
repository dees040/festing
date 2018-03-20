<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festing', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->text('body')->nullable();
            $table->timestamps();
        });

        \Illuminate\Support\Facades\DB::table('festing')
            ->insert([
                ['name' => 'Test0', 'body' => 'Test body, Test body, Test body, Test body, Test body, Test body.'],
                ['name' => 'Test1', 'body' => 'Test body, Test body, Test body, Test body, Test body, Test body.'],
                ['name' => 'Test2', 'body' => 'Test body, Test body, Test body, Test body, Test body, Test body.'],
                ['name' => 'Test3', 'body' => 'Test body, Test body, Test body, Test body, Test body, Test body.'],
                ['name' => 'Test4', 'body' => 'Test body, Test body, Test body, Test body, Test body, Test body.'],
                ['name' => 'Test5', 'body' => 'Test body, Test body, Test body, Test body, Test body, Test body.'],
                ['name' => 'Test6', 'body' => 'Test body, Test body, Test body, Test body, Test body, Test body.'],
                ['name' => 'Test7', 'body' => 'Test body, Test body, Test body, Test body, Test body, Test body.'],
                ['name' => 'Test8', 'body' => 'Test body, Test body, Test body, Test body, Test body, Test body.'],
                ['name' => 'Test9', 'body' => 'Test body, Test body, Test body, Test body, Test body, Test body.'],
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('festing');
    }
}

