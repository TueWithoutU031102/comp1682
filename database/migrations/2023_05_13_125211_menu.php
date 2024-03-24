<?php

use App\Models\Type;
use App\Enums\StatusMenu;
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
        DB::table('tables')->insert([
            [
                'name' => 'Chè bưởi',
                'type_id' => '1',
                'status' => StatusMenu::Available->value,
                'price' => '15000',
                'description' => 'Chè bưởi',
                'image' => '/images/chebuoi.png',
                'saled' => '0'
            ],
            [
                'name' => 'Combo 1',
                'type_id' => '4',
                'status' => StatusMenu::Available->value,
                'price' => '35000',
                'description' => 'Combo gồm khô gà và trà tắc trân châu',
                'image' => '/images/combo1.png',
                'saled' => '0'
            ],
            [
                'name' => 'Hạt thập cẩm',
                'type_id' => '3',
                'status' => StatusMenu::Available->value,
                'price' => '15000',
                'description' => 'Hạt thập cẩm',
                'image' => '/images/hatthapcam.png',
                'saled' => '0'
            ],
            [
                'name' => 'Hạt hướng dương',
                'type_id' => '3',
                'status' => StatusMenu::Available->value,
                'price' => '15000',
                'description' => 'Hạt hướng dương',
                'image' => '/images/hathuongduong.png',
                'saled' => '0'
            ],
            [
                'name' => 'Chè khoai dẻo',
                'type_id' => '1',
                'status' => StatusMenu::Available->value,
                'price' => '15000',
                'description' => 'Chè khoai dẻo',
                'image' => '/images/khoaideo.png',
                'saled' => '0'
            ],
            [
                'name' => 'Khô gà',
                'type_id' => '3',
                'status' => StatusMenu::Available->value,
                'price' => '15000',
                'description' => 'Khô gà',
                'image' => '/images/khoga.png',
                'saled' => '0'
            ],
            [
                'name' => 'Chè khúc bạch',
                'type_id' => '1',
                'status' => StatusMenu::Available->value,
                'price' => '15000',
                'description' => 'Chè khúc bạch',
                'image' => '/images/khucbach.png',
                'saled' => '0'
            ],
            [
                'name' => 'Soda xanh lá',
                'type_id' => '2',
                'status' => StatusMenu::Available->value,
                'price' => '15000',
                'description' => 'Soda syrup',
                'image' => '/images/sodaxanhla.png',
                'saled' => '0'
            ],
            [
                'name' => 'Soda xanh biển',
                'type_id' => '2',
                'status' => StatusMenu::Available->value,
                'price' => '15000',
                'description' => 'Soda syrup',
                'image' => '/images/sodaxanhbien.png',
                'saled' => '0'
            ],
            [
                'name' => 'Soda đỏ',
                'type_id' => '2',
                'status' => StatusMenu::Available->value,
                'price' => '15000',
                'description' => 'Soda syrup',
                'image' => '/images/sodado.png',
                'saled' => '0'
            ],
            [
                'name' => 'Trà tắc',
                'type_id' => '2',
                'status' => StatusMenu::Available->value,
                'price' => '15000',
                'description' => 'Trà tắc',
                'image' => '/images/tratac.png',
                'saled' => '0'
            ],
        ]);
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
