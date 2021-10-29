<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('manager_id');
            $table->integer('point_id');
            $table->integer('scooter_id');
            $table->decimal('amount', 10, 2);
            $table->string('document', 500);
            $table->timestamp('date_start')->useCurrent();
            $table->date('date_end')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('rents');
    }
}
