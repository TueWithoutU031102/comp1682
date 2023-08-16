<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id'); // ID của món ăn
            $table->foreign('menu_id')
                ->cascadeOnDelete()
                ->references('id')
                ->on('menus');
            $table->unsignedBigInteger('quantity'); // Số lượng
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};