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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('restrict');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');
            $table->unsignedBigInteger('variant_id');
            $table->foreign('variant_id')->references('id')->on('variants')->onDelete('restrict');
            $table->integer('quantity');
            $table->float('price');
			$table->string('comments')->nullable();
			$table->string('additional_comments')->nullable();
			$table->longText('additional_image')->nullable();;
            $table->float('discount')->default(0);
            $table->float('subtotal');
            $table->float('tax');
            $table->unsignedBigInteger('tax_id');
            $table->float('total');
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
        Schema::dropIfExists('order_items');
    }
};
