<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('type_id')
                ->cascadeOnDelete()
                ->references('id')
                ->on('types');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')
                ->cascadeOnDelete()
                ->references('id')
                ->on('statusMenu');
            $table->integer('price');
            $table->longText('description');
            $table->longText('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('menus');
    }
};
