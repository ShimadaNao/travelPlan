<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planDetails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id');
            $table->string('name');
            $table->text('latitude');
            $table->text('longitude');
            $table->date('dayToVisit')->comment('訪問予定日')->nullable();
            $table->time('timeToVisit')->comment('訪問予定時間')->nullable();
            $table->text('comment')->comment('好きなコメント')->nullable();
            $table->timestamps();

            $table->foreign('plan_id')
            ->references('id')
            ->on('plans')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planDetails');
    }
}
