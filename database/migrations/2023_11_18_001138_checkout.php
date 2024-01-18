<?php

use App\Enums\StatusCheckout;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Table;
use App\Models\Session;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('checkouts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Table::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('mssv')->unique();
            $table->string('phone')->unique();
            $table->integer('total');
            $table->string('status')->default(StatusCheckout::Pending->value);
            $table->string('transaction_id')->nullable();
            $table->timestamps();
        });

        Schema::create('cart_checkout', function (Blueprint $table) {
            $table->foreignId('checkout_id')->constrained()->cascadeOnDelete();
            $table->foreignId('cart_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkouts');
    }
};
