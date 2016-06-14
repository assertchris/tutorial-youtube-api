<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelTable extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        Schema::create("channel", function (Blueprint $table) {
            $table->increments("id");
            $table->string("youtube_id")->index();
            $table->string("youtube_title");
            $table->timestamps();
        });
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        Schema::dropIfExists("channel");
    }
}
