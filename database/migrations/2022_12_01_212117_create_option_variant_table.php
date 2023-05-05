<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_variant', function (Blueprint $table) {
            $table->primary(['option_id', 'variant_id']);
            $table->unsignedBigInteger('option_id');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('restrict');
            $table->unsignedBigInteger('variant_id');
            $table->foreign('variant_id')->references('id')->on('variants')->onDelete('restrict');
            $table->float('price');
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
        Schema::dropIfExists('option_variant');
    }
};
