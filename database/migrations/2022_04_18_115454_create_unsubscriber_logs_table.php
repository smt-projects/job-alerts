<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnsubscriberLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unsubscriber_logs', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('subscriber_id');
            // $table->text('email_content');
            $table->integer('unsubscribed_for');
            $table->integer('notify');
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
        Schema::dropIfExists('unsubscriber_logs');
    }
}
