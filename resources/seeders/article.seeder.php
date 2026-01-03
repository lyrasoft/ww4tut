<?php

declare(strict_types=1);

namespace App\Seeder;

use App\Entity\Article;
use App\Enum\ItemState;
use Windwalker\Core\Seed\AbstractSeeder;
use Windwalker\Core\Seed\SeedClear;
use Windwalker\Core\Seed\SeedImport;
use Windwalker\ORM\EntityMapper;

return new /** Article Seeder */ class extends AbstractSeeder {
    #[SeedImport]
    public function import(): void
    {
        $faker = $this->faker('en_US');

        /** @var EntityMapper<Article> $mapper */
        $mapper = $this->orm->mapper(Article::class);

        foreach (range(1, 50) as $i) {
            $item = $mapper->createEntity();
            $item->title = $faker->sentence(2);
            $item->image = 'https://placeholdit.com/600x400/dddddd/999999';
            $item->content = $faker->paragraph(40);
            $item->state = $faker->randomElement(ItemState::cases());
            $item->createdBy = 1; // 現在沒有User，先填 1
            $item->categoryId = 1; // 現在沒有分類，先填 1
            $item->created = $faker->dateTimeThisYear();
            $item->params = [
                'show_date' => true,
                'show_author' => false,
            ];

            $article = $mapper->createOne($item);

            $this->printCounting();
        }
    }

    #[SeedClear]
    public function clear(): void
    {
        $this->truncate(Article::class);
    }
};
