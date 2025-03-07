<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'title' => 'Ürünlerinizin iade süresi nedir?',
                'description' => 'Müşterilerimizin sıkça sorduğu iade süresi hakkında bilgi.',
                'is_active' => true,
                'order' => 1,
                'answers' => [
                    [
                        'content' => 'Ürünlerimizin iade süresi, teslimat tarihinden itibaren 14 gündür.',
                        'order' => 1
                    ],
                    [
                        'content' => 'İade sürecini başlatmak için müşteri hizmetlerimizle iletişime geçebilirsiniz.',
                        'order' => 2
                    ],
                    [
                        'content' => 'Ürünün kullanılmamış ve orijinal ambalajında olması gerekmektedir.',
                        'order' => 3
                    ]
                ]
            ],
            [
                'title' => 'Kargo ücretleri nasıl hesaplanıyor?',
                'description' => 'Kargo ücretlendirmesi hakkında detaylı bilgi.',
                'is_active' => true,
                'order' => 2,
                'answers' => [
                    [
                        'content' => '250 TL ve üzeri alışverişlerinizde kargo ücretsizdir.',
                        'order' => 1
                    ],
                    [
                        'content' => '250 TL altındaki siparişlerde sabit 29.90 TL kargo ücreti alınmaktadır.',
                        'order' => 2
                    ]
                ]
            ],
            [
                'title' => 'Hangi ödeme yöntemlerini kullanabiliyorum?',
                'description' => 'Mevcut ödeme seçenekleri hakkında bilgi.',
                'is_active' => true,
                'order' => 3,
                'answers' => [
                    [
                        'content' => 'Kredi kartı ile tek çekim veya taksitli ödeme yapabilirsiniz.',
                        'order' => 1
                    ],
                    [
                        'content' => 'Havale/EFT ile ödeme yapabilirsiniz.',
                        'order' => 2
                    ],
                    [
                        'content' => 'Kapıda ödeme seçeneği mevcuttur (5 TL ek ücret uygulanır).',
                        'order' => 3
                    ]
                ]
            ],
            [
                'title' => 'Siparişim ne zaman elime ulaşır?',
                'description' => 'Teslimat süreleri hakkında bilgilendirme.',
                'is_active' => true,
                'order' => 4,
                'answers' => [
                    [
                        'content' => 'Siparişleriniz genellikle 1-3 iş günü içerisinde kargoya verilmektedir.',
                        'order' => 1
                    ],
                    [
                        'content' => 'Kargoya verildikten sonra ortalama 2-4 iş günü içerisinde teslimat yapılmaktadır.',
                        'order' => 2
                    ],
                    [
                        'content' => 'Teslimat süreleri, bulunduğunuz bölgeye göre değişiklik gösterebilir.',
                        'order' => 3
                    ]
                ]
            ],
            [
                'title' => 'Ürün değişimi yapabilir miyim?',
                'description' => 'Ürün değişim koşulları hakkında bilgi.',
                'is_active' => true,
                'order' => 5,
                'answers' => [
                    [
                        'content' => 'Evet, ürünlerimizde 30 gün içerisinde değişim yapabilirsiniz.',
                        'order' => 1
                    ],
                    [
                        'content' => 'Değişim için ürünün kullanılmamış ve orijinal ambalajında olması gerekmektedir.',
                        'order' => 2
                    ],
                    [
                        'content' => 'Değişim sürecini başlatmak için müşteri hizmetlerimizle iletişime geçebilirsiniz.',
                        'order' => 3
                    ]
                ]
            ]
        ];

        foreach ($questions as $questionData) {
            $answers = $questionData['answers'];
            unset($questionData['answers']);
            
            $question = Question::create($questionData);
            
            foreach ($answers as $answer) {
                $question->answers()->create($answer);
            }
        }
    }
}
