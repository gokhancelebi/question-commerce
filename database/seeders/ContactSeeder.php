<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            [
                'user_id' => 2, // Ahmet Yılmaz
                'name' => 'Ahmet',
                'surname' => 'Yılmaz',
                'email' => 'ahmet@example.com',
                'subject' => 'Ürün Bilgi Talebi',
                'message' => 'Merhaba, X model ürününüz hakkında detaylı bilgi almak istiyorum. Stok durumu ve fiyat bilgisi paylaşabilir misiniz?',
                'status' => 'pending',
                'created_at' => now()->subDays(5),
            ],
            [
                'user_id' => 3, // Ayşe Demir
                'name' => 'Ayşe',
                'surname' => 'Demir',
                'email' => 'ayse@example.com',
                'subject' => 'Sipariş Durumu',
                'message' => 'Geçen hafta verdiğim siparişin durumunu öğrenebilir miyim? Sipariş numaram: #12345',
                'status' => 'read',
                'created_at' => now()->subDays(3),
            ],
            [
                'user_id' => 4, // Mehmet Kaya
                'name' => 'Mehmet',
                'surname' => 'Kaya',
                'email' => 'mehmet@example.com',
                'subject' => 'Teknik Destek',
                'message' => 'Web sitenizde ödeme yaparken hata alıyorum. Kredi kartı ile ödeme seçeneğinde işlem tamamlanmıyor.',
                'status' => 'replied',
                'reply' => 'Merhaba Mehmet Bey, teknik ekibimiz sorununuzu çözmüştür. Tekrar deneyebilirsiniz. Sorun devam ederse bize tekrar ulaşabilirsiniz.',
                'replied_at' => now()->subHours(12),
                'created_at' => now()->subDay(),
            ],
            [
                'name' => 'Zeynep',
                'surname' => 'Şahin',
                'email' => 'zeynep.sahin@example.com',
                'subject' => 'İade Talebi',
                'message' => 'Aldığım ürünü iade etmek istiyorum. Ürün beklediğim gibi çıkmadı. İade sürecini nasıl başlatabilirim?',
                'status' => 'pending',
                'created_at' => now()->subHours(6),
            ],
            [
                'name' => 'Can',
                'surname' => 'Öztürk',
                'email' => 'can.ozturk@example.com',
                'subject' => 'Teşekkür Mesajı',
                'message' => 'Hızlı teslimat ve kaliteli ürün için teşekkür ederim. Çok memnun kaldım.',
                'status' => 'replied',
                'reply' => 'Merhaba Can Bey, değerli geri bildiriminiz için biz teşekkür ederiz. Tekrar bekleriz.',
                'replied_at' => now(),
                'created_at' => now()->subHours(2),
            ],
        ];

        foreach ($contacts as $contact) {
            \App\Models\Contact::create($contact);
        }
    }
}
