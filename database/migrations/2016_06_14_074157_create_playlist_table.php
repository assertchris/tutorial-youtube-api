<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistTable extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        Schema::create("playlist", function (Blueprint $table) {
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
        Schema::dropIfExists("playlist");
    }
}
