<?php

use App\Models\Type;
use App\Enums\StatusMenu;
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
            $table->foreignIdFor(Type::class)->constrained()->cascadeOnDelete();
            $table->string('status')->default(StatusMenu::Available->value);
            $table->integer('price');
            $table->longText('description')->nullable();
            $table->longText('image')->nullable();
            $table->integer('saled')->default('0');
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
