<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
            $table->integer('ordering')->default(0);
            $table->integer('object_id')->nullable();
            $table->enum('object_type', ['setting','employee', 'project', 'user','company', 'other', 'tmp'])->default('tmp');
            $table->enum('file_type',['photo', 'other'])->default('photo');
            $table->enum('status',['deleted','used', 'profile'])->default('used');
            $table->string('att_name', 20)->nullable();
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
        Schema::dropIfExists('photos');
    }
}
