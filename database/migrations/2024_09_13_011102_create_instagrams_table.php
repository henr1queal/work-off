<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstagramsTable extends Migration
{
    public function up()
    {
        Schema::create('instagrams', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->string('username');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('instagrams');
    }
}
