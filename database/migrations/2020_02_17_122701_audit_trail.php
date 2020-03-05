<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AuditTrail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audit_trail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type',50)->nullable();
            $table->string('comment',500)->nullable();
            $table->string('status_id',500)->nullable();
            $table->integer('created_by');
            $table->integer('ticket_log_id');
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
        Schema::dropIfExists('audit_trail');
    }
}
