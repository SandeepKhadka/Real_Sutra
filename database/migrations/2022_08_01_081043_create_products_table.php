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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('summary');
            $table->longText('description')->nullable();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->unsignedBigInteger('sub_cat_id')->nullable();
            $table->string('image')->nullable();
            $table->float('price');
            $table->float('discount')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->string('brand')->nullable();
            $table->integer('stock')->default(0);
            $table->unsignedBigInteger('added_by')->nullable();
            $table->enum('status',['active','out_of_stock','inactive'])->default('inactive');
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->foreign('sub_cat_id')->references('id')->on('categories')->onDelete('SET NULL');
            $table->enum('conditions', ['hot', 'new', 'winter', 'sale', 'for_you'])->default('new');
            $table->foreign('added_by')->references('id')->on('users')->onDelete('SET NULL');
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
        Schema::dropIfExists('products');
    }
};
