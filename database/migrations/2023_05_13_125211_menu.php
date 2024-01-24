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

        DB::table('menus')->insert([
            [
                'name' => 'Chè khúc bạch',
                'type_id' => '1',
                'status' => StatusMenu::Available->value,
                'price' => '25000',
                'description' => 'Chè khúc bạch là một món tráng miệng truyền thống của nền văn hóa ẩm thực Trung Quốc, với thành phần chính là bột nếp trắng được trải qua quá trình nấu chín, sau đó cuộn vào hình tròn nhỏ giống như viên tròn trắng, thêm nước cốt dừa và đường để tạo ra hương vị độc đáo và thơm ngon.',
                'image' => '/images/khucbach.png',
                'saled' => '0'
            ],
            [
                'name' => 'Tàu hủ chân trâu',
                'type_id' => '1',
                'status' => StatusMenu::Available->value,
                'price' => '25000',
                'description' => 'Tàu hủ trân châu',
                'image' => '/images/tauhu.png',
                'saled' => '0'
            ],

            [
                'name' => 'Chè bưởi',
                'type_id' => '1',
                'status' => StatusMenu::Available->value,
                'price' => '25000',
                'description' => 'Với hương thơm dễ chịu của lá bưởi và vị ngọt thanh của đường, chè bưởi không chỉ là một món tráng miệng ngon miệng mà còn mang lại cảm giác sảng khoái và tinh tế, là điểm nhấn tuyệt vời cho bữa ăn truyền thống Việt Nam.',
                'image' => '/images/chebuoi.png',
                'saled' => '0'
            ],
            [
                'name' => 'Chè khoai dẻo',
                'type_id' => '1',
                'status' => StatusMenu::Available->value,
                'price' => '25000',
                'description' => 'Chè khoai dẻo là một món tráng miệng phổ biến trong ẩm thực Việt Nam, được làm từ khoai lang, một loại khoai có hương vị đặc trưng, được bào nhuyễn và trộn với bột nếp để tạo ra lớp vỏ mềm mịn',
                'image' => '/images/khoaideo.png',
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
                'name' => 'Soda tím',
                'type_id' => '2',
                'status' => StatusMenu::Available->value,
                'price' => '15000',
                'description' => 'Soda syrup',
                'image' => '/images/sodatim.png',
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
            [
                'name' => 'Hạt hướng dương',
                'type_id' => '3',
                'status' => StatusMenu::Available->value,
                'price' => '15000',
                'description' => 'Hạt hướng dương',
                'image' => '/images/huongduong.png',
                'saled' => '0'
            ],
            [
                'name' => 'Hạt tổng hợp',
                'type_id' => '3',
                'status' => StatusMenu::Available->value,
                'price' => '15000',
                'description' => 'Hạt tổng hợp',
                'image' => '/images/hatthapcam.png',
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
                'name' => 'Bánh tráng cuộn bò hành',
                'type_id' => '3',
                'status' => StatusMenu::Available->value,
                'price' => '30000',
                'description' => 'Bánh tráng cuộn bò hành',
                'image' => '/images/cuonbohanh.png',
                'saled' => '0'
            ],
            [
                'name' => 'Bánh tráng trộn thập cẩm',
                'type_id' => '3',
                'status' => StatusMenu::Available->value,
                'price' => '30000',
                'description' => 'Bánh tráng trộn thập cẩm',
                'image' => '/images/tronthapcam.png',
                'saled' => '0'
            ],
            [
                'name' => 'Combo vui vẻ',
                'type_id' => '4',
                'status' => StatusMenu::Available->value,
                'price' => '35000',
                'description' => 'Combo gồm khô gà và trà tắc',
                'image' => '/images/combo1.png',
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
