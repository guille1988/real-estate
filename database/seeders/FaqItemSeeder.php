<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\FaqItem;
use Illuminate\Database\Seeder;

final class FaqItemSeeder extends Seeder
{
    /**
     * @var array<int, array<string, list<string>|string>>
     */
    private array $faqItems = [
        [
            'subtitle' => 'Lorem ipsum dolor sit amet',
            'paragraphs' => [
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor.',
            ],
        ],
        [
            'subtitle' => 'Consectetur adipiscing elit',
            'paragraphs' => [
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.',
            ],
        ],
        [
            'subtitle' => 'Pellentesque ornare sem',
            'paragraphs' => [
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.',
            ],
        ],
        [
            'subtitle' => 'Tellus ac cursus commodo',
            'paragraphs' => [
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor.',
                'Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Etiam porta sem malesuada magna mollis euismod. Vestibulum id ligula porta felis euismod semper.',
            ],
        ],
        [
            'subtitle' => 'Integer posuere erat',
            'paragraphs' => [
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cras mattis consectetur purus sit amet fermentum. Curabitur blandit tempus porttitor. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.',
            ],
        ],
        [
            'subtitle' => 'Vestibulum id ligula porta',
            'paragraphs' => [
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas sed diam eget risus varius blandit sit amet non magna. Nullam quis risus eget urna mollis ornare vel eu leo. Cras mattis consectetur purus sit amet fermentum. Donec id elit non mi porta gravida at eget metus. Donec ullamcorper nulla non metus auctor fringilla.',
                'Vestibulum id ligula porta felis euismod semper. Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
            ],
        ],
        [
            'subtitle' => 'Etiam porta sem malesuada',
            'paragraphs' => [
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras mattis consectetur purus sit amet fermentum. Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.',
                'Etiam porta sem malesuada magna mollis euismod. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
            ],
        ],
        [
            'subtitle' => 'Metus auctor fringilla',
            'paragraphs' => [
                '"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quis risus eget urna mollis ornare vel eu leo. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nullam id dolor id nibh ultricies vehicula ut id elit."',
                '"Cras mattis consectetur purus sit amet fermentum. Donec id elit non mi porta gravida at eget metus. Vestibulum id ligula porta felis euismod semper. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui."',
                '"Donec ullamcorper nulla non metus auctor fringilla. Nullam quis risus eget urna mollis ornare vel eu leo. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh."',
            ],
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::query()
            ->get('id')
            ->each(function (Faq $faq): void {
                $faqItems = [];

                foreach ($this->faqItems as $faqItem) {
                    $faqItem['faq_id'] = $faq->id;
                    $faqItems[] = $faqItem;
                }

                FaqItem::fillAndInsert($faqItems);
            });
    }
}
