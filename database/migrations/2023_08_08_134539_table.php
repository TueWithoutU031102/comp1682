<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        DB::table('tables')->insert([
            [
                'name' => 'Bàn 1',
            ],
            [
                'name' => 'Bàn 2'
            ],
            [
                'name' => 'Bàn 3'
            ],
            [
                'name' => 'Bàn 4'
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('tables');
    }
};
