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
            // General Questions
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
            
            // Shipping Questions
            [
                'question' => 'Sipariş verdikten sonra ne kadar sürede elime ulaşır?',
                'answer' => '<p>Siparişiniz onaylandıktan sonra, genellikle 1-3 iş günü içerisinde kargoya verilir. Teslimat süresi, bulunduğunuz konuma ve seçtiğiniz kargo firmasına göre değişiklik gösterebilir. Genel olarak, kargoya verildikten sonra 1-4 iş günü içerisinde siparişiniz elinize ulaşacaktır.</p>',
                'order' => 3,
                'is_active' => true
            ],
            [
                'question' => 'Kargo takibini nasıl yapabilirim?',
                'answer' => '<p>Siparişiniz kargoya verildikten sonra, size bir kargo takip numarası gönderilecektir. Bu numara ile ilgili kargo firmasının web sitesi üzerinden takip işlemlerini gerçekleştirebilirsiniz. Ayrıca, hesabınızdaki "Siparişlerim" sayfasından da kargo durumunu kontrol edebilirsiniz.</p>',
                'order' => 4,
                'is_active' => true
            ],
            
            // Return & Refund Questions
            [
                'question' => 'Ürün iade koşulları nelerdir?',
                'answer' => '<p>Ürünlerimizi teslim aldığınız tarihten itibaren 14 gün içerisinde herhangi bir sebep belirtmeksizin iade edebilirsiniz. İade etmek istediğiniz ürünün kullanılmamış, etiketlerinin sökülmemiş ve orijinal ambalajında olması gerekmektedir. İade işlemi için öncelikle müşteri hizmetlerimizle iletişime geçmeniz gerekmektedir.</p>',
                'order' => 5,
                'is_active' => true
            ],
            [
                'question' => 'Para iadesi ne kadar sürede yapılır?',
                'answer' => '<p>İade ettiğiniz ürün tarafımıza ulaşıp kontrol edildikten sonra, genellikle 3-5 iş günü içerisinde iade işleminiz onaylanır. Para iadesi, ödeme yaptığınız kart veya banka hesabına, bankaların işlem sürelerine bağlı olarak 7-14 iş günü içerisinde gerçekleştirilir.</p>',
                'order' => 6,
                'is_active' => true
            ],
            
            // Account Questions
            [
                'question' => 'Siparişimi nasıl takip edebilirim?',
                'answer' => '<p>Siparişinizi takip etmek için hesabınıza giriş yaparak "Siparişlerim" sayfasını ziyaret edebilirsiniz. Burada, siparişinizin durumu ve kargo takip bilgilerine ulaşabilirsiniz. Ayrıca, siparişiniz kargoya verildiğinde size bir bilgilendirme e-postası gönderilecek ve bu e-postada kargo takip numarası yer alacaktır.</p>',
                'order' => 7,
                'is_active' => true
            ],
            [
                'question' => 'Şifremi unuttum, ne yapmalıyım?',
                'answer' => '<p>Şifrenizi unuttuysanız, giriş sayfasında yer alan "Şifremi Unuttum" bağlantısına tıklayabilirsiniz. E-posta adresinizi girdikten sonra, şifre sıfırlama bağlantısı içeren bir e-posta alacaksınız. Bu bağlantıya tıklayarak yeni bir şifre oluşturabilirsiniz.</p>',
                'order' => 8,
                'is_active' => true
            ],
            
            // Payment Questions
            [
                'question' => 'Hangi ödeme yöntemlerini kabul ediyorsunuz?',
                'answer' => '<p>Kredi kartı, banka kartı, havale/EFT ve kapıda ödeme seçeneklerini sunmaktayız. Kredi kartı ile yapılan ödemelerde taksit imkanı da bulunmaktadır. Anlaşmalı bankalar ve taksit seçenekleri için ödeme sayfasını ziyaret edebilirsiniz.</p>',
                'order' => 9,
                'is_active' => true
            ],
            [
                'question' => 'Kapıda ödeme seçeneği mevcut mu?',
                'answer' => '<p>Evet, kapıda nakit veya kredi kartı ile ödeme seçeneği mevcuttur. Ancak, kapıda ödeme seçeneğinde ekstra bir hizmet bedeli tahsil edilmektedir. Bu bedel, siparişinizin toplam tutarına eklenir ve ödeme sayfasında görüntülenir.</p>',
                'order' => 10,
                'is_active' => true
            ]
        ];

        foreach ($faqs as $faq) {
            FAQ::create($faq);
        }
    }
}
