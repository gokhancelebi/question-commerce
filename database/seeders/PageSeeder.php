<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Hakkımızda',
                'slug' => 'hakkimizda',
                'content' => '<p>Question Commerce, alışveriş deneyimini kişiselleştirmek ve müşterilere en uygun ürünleri sunmak amacıyla kurulmuş yenilikçi bir e-ticaret platformudur.</p>
                            <p>Misyonumuz, müşterilerimizin ihtiyaçlarını en iyi şekilde anlayarak, onlara tam olarak aradıkları ürünleri sunmaktır. Bunu yaparken, kullanıcı dostu bir arayüz ve akıllı soru-cevap sistemi kullanarak alışveriş sürecini kolaylaştırıyoruz.</p>',
                'meta_title' => 'Hakkımızda - Question Commerce',
                'meta_description' => 'Question Commerce hakkında bilgi edinin. Misyonumuz, vizyonumuz ve değerlerimizi keşfedin.',
                'order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Nasıl Çalışır',
                'slug' => 'nasil-calisir',
                'content' => '<h2>Adım Adım Question Commerce</h2>
                            <ol>
                                <li>Basit sorularımızı yanıtlayın</li>
                                <li>Tercihlerinize göre özelleştirilmiş ürün önerilerini alın</li>
                                <li>Size en uygun ürünü seçin ve satın alın</li>
                            </ol>
                            <p>Akıllı algoritmamız, yanıtlarınızı analiz ederek size en uygun ürünleri önerir. Bu sayede uzun araştırma süreçlerine gerek kalmadan, ihtiyacınız olan ürünü bulabilirsiniz.</p>',
                'meta_title' => 'Nasıl Çalışır - Question Commerce',
                'meta_description' => 'Question Commerce nasıl çalışır? Kişiselleştirilmiş alışveriş deneyimi hakkında bilgi edinin.',
                'order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'İletişim',
                'slug' => 'iletisim',
                'content' => '<h2>Bizimle İletişime Geçin</h2>
                            <p>Sorularınız, önerileriniz veya geri bildirimleriniz için bizimle iletişime geçebilirsiniz.</p>
                            <ul>
                                <li>E-posta: info@questioncommerce.com</li>
                                <li>Telefon: +90 (212) XXX XX XX</li>
                                <li>Adres: İstanbul, Türkiye</li>
                            </ul>',
                'meta_title' => 'İletişim - Question Commerce',
                'meta_description' => 'Question Commerce ile iletişime geçin. Sorularınız ve önerileriniz için bize ulaşın.',
                'order' => 3,
                'is_active' => true
            ],
            [
                'title' => 'Müşteri Desteği',
                'slug' => 'musteri-destegi',
                'content' => '<h2>Müşteri Desteği</h2>
                            <p>Question Commerce olarak, müşterilerimize en iyi hizmeti sunmak için buradayız. Herhangi bir sorunuz veya sorununuz olduğunda, aşağıdaki kanallar aracılığıyla bize ulaşabilirsiniz:</p>
                            <ul>
                                <li><strong>Telefon:</strong> +90 (212) XXX XX XX (Hafta içi 09:00-18:00)</li>
                                <li><strong>E-posta:</strong> destek@questioncommerce.com</li>
                                <li><strong>Canlı Sohbet:</strong> Web sitemizin sağ alt köşesindeki sohbet simgesine tıklayarak</li>
                            </ul>
                            <p>Müşteri memnuniyeti bizim için önceliktir ve sorularınızı en kısa sürede yanıtlamak için çalışıyoruz.</p>',
                'meta_title' => 'Müşteri Desteği - Question Commerce',
                'meta_description' => 'Question Commerce müşteri destek hizmetleri. Sorularınız ve sorunlarınız için bize ulaşın.',
                'order' => 4,
                'is_active' => true
            ]
        ];

        foreach ($pages as $page) {
            Page::create($page);
        }
    }
}
