<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartments_id')->references('id')->on('apartments');
            $table->foreignId('clients_id')->references('id')->on('clients');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('price_day');
            $table->integer('money_total');
            $table->integer('money_paid')->nullable();
            $table->enum('status', ['Not paid','Partially paid', 'Fully Paid', 'Cancelled', 'Not available']);
            $table->integer('adults')->nullable();
            $table->integer('kids')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('reservations');
    }
}
