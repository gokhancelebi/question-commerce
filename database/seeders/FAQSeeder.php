<?php

namespace Database\Seeders;

use App\Models\FAQ;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Question Commerce nasıl çalışır?',
                'answer' => '<p>Question Commerce, kullanıcıların basit sorulara verdikleri yanıtlara göre kişiselleştirilmiş ürün önerileri sunan bir e-ticaret platformudur. Sistemimiz, tercihlerinizi analiz ederek size en uygun ürünleri bulmanıza yardımcı olur.</p>',
                'order' => 1,
                'is_active' => true
            ],
            [
                'question' => 'Önerilen ürünleri nasıl satın alabilirim?',
                'answer' => '<p>Size önerilen ürünleri inceledikten sonra, "Sepete Ekle" butonuna tıklayarak sepetinize ekleyebilirsiniz. Ardından ödeme adımlarını takip ederek satın alma işlemini tamamlayabilirsiniz. Ödeme sayfasında kredi kartı, banka kartı veya havale/EFT gibi ödeme seçeneklerinden birini tercih edebilirsiniz.</p>',
                'order' => 2,
                'is_active' => true
            ],
            [
                'question' => 'Sipariş verdikten sonra ne kadar sürede elime ulaşır?',
                'answer' => '<p>Siparişiniz onaylandıktan sonra, genellikle 1-3 iş günü içerisinde kargoya verilir. Teslimat süresi, bulunduğunuz konuma ve seçtiğiniz kargo firmasına göre değişiklik gösterebilir. Genel olarak, kargoya verildikten sonra 1-4 iş günü içerisinde siparişiniz elinize ulaşacaktır.</p>',
                'order' => 3,
                'is_active' => true
            ],
            [
                'question' => 'Ürün iade koşulları nelerdir?',
                'answer' => '<p>Ürünlerimizi teslim aldığınız tarihten itibaren 14 gün içerisinde herhangi bir sebep belirtmeksizin iade edebilirsiniz. İade etmek istediğiniz ürünün kullanılmamış, etiketlerinin sökülmemiş ve orijinal ambalajında olması gerekmektedir. İade işlemi için öncelikle müşteri hizmetlerimizle iletişime geçmeniz gerekmektedir.</p>',
                'order' => 4,
                'is_active' => true
            ],
            [
                'question' => 'Siparişimi nasıl takip edebilirim?',
                'answer' => '<p>Siparişinizi takip etmek için hesabınıza giriş yaparak "Siparişlerim" sayfasını ziyaret edebilirsiniz. Burada, siparişinizin durumu ve kargo takip bilgilerine ulaşabilirsiniz. Ayrıca, siparişiniz kargoya verildiğinde size bir bilgilendirme e-postası gönderilecek ve bu e-postada kargo takip numarası yer alacaktır.</p>',
                'order' => 5,
                'is_active' => true
            ]
        ];

        foreach ($faqs as $faq) {
            FAQ::create($faq);
        }
    }
}
