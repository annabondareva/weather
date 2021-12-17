<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeometryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'geometry',
            function (Blueprint $table) {
                $table->id();
                $table->string('event_id', 64);
                $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
                $table->json('coordinates');
                $table->string('date_and_time', 128);
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geometry');
    }
}
