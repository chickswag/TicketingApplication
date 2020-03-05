<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TicketLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('department_id');
            $table->string('description',500);
            $table->string('reference',50)->nullable();
            $table->integer('status_id');
            $table->integer('created_by');
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->string('email')->nullable();
            $table->string('contact' ,15);
            $table->longText('agent_location');
            $table->softDeletes();
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
        Schema::dropIfExists('ticket_log');
    }
}
