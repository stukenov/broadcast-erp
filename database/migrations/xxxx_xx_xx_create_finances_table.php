<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancesTable extends Migration
{
    public function up()
    {
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_type');
            $table->decimal('amount', 10, 2);
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('finances');
    }
}