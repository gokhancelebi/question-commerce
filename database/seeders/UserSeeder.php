<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'surname' => 'User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create regular users with shipping info
        $users = [
            [
                'name' => 'Ahmet',
                'surname' => 'Yılmaz',
                'email' => 'ahmet@example.com',
                'default_shipping_name' => 'Ahmet',
                'default_shipping_surname' => 'Yılmaz',
                'default_shipping_phone' => '5551234567',
                'default_city' => 'İstanbul',
                'default_district' => 'Kadıköy',
                'default_address' => 'Bağdat Caddesi No:123',
            ],
            [
                'name' => 'Ayşe',
                'surname' => 'Demir',
                'email' => 'ayse@example.com',
                'default_shipping_name' => 'Ayşe',
                'default_shipping_surname' => 'Demir',
                'default_shipping_phone' => '5559876543',
                'default_city' => 'İstanbul',
                'default_district' => 'Beşiktaş',
                'default_address' => 'Barbaros Bulvarı No:456',
            ],
            [
                'name' => 'Mehmet',
                'surname' => 'Kaya',
                'email' => 'mehmet@example.com',
                'default_shipping_name' => 'Mehmet',
                'default_shipping_surname' => 'Kaya',
                'default_shipping_phone' => '5553334444',
                'default_city' => 'Ankara',
                'default_district' => 'Çankaya',
                'default_address' => 'Tunalı Hilmi Caddesi No:789',
            ],
        ];

        foreach ($users as $userData) {
            User::create(array_merge($userData, [
                'password' => Hash::make('password'),
                'role' => 'user',
            ]));
        }
    }
}
