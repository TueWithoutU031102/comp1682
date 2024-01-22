<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role')->default(Role::Staff->value);
            $table->string('phone')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'Admin',
                'phone' => '0393608622',
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'manager',
                'email' => 'manager@gmail.com',
                'role' => 'Manager',
                'phone' => '0123456789',
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Yến Nhi',
                'email' => 'nhi@gmail.com',
                'role' => 'Manager',
                'phone' => '0123456789',
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Mei Linh',
                'email' => 'meilinh@gmail.com',
                'role' => 'Manager',
                'phone' => '0123456789',
                'password' => Hash::make('123456'),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
