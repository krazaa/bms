<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('account_id');
            $table->integer('vendor_id')->nullable();
            $table->date('paid_at');
            $table->double('amount', 15, 4);
            $table->text('description')->nullable();
            $table->string('payment_method');
            $table->timestamps();
            $table->softDeletes();

            $table->index('account_id');
            $table->index('vendor_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
