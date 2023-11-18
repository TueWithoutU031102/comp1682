<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\StatusDish;
use App\Models\Menu;
use App\Models\Session;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Menu::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Session::class)->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('quantity'); // Số lượng
            $table->string('status')->default(StatusDish::Waiting->value);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
