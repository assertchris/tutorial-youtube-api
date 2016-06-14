<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        Schema::create("user", function (Blueprint $table) {
            $table->increments("id");
            $table->string("youtube_id")->index()->unique();
            $table->string("youtube_token");
            $table->timestamps();
        });
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        Schema::dropIfExists("user");
    }
}
