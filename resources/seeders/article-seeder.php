<?php

/**
 * Part of starter project.
 *
 * @copyright  Copyright (C) 2021 __ORGANIZATION__.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Seeder;

use App\Entity\Article;
use Windwalker\Core\Seed\Seeder;
use Windwalker\Database\DatabaseAdapter;
use Windwalker\ORM\EntityMapper;
use Windwalker\ORM\ORM;

/**
 * Article Seeder
 *
 * @var Seeder          $seeder
 * @var ORM             $orm
 * @var DatabaseAdapter $db
 */
$seeder->import(
    static function () use ($seeder, $orm, $db) {
        $faker = $seeder->faker('en_US');

        /** @var EntityMapper<Article> $mapper */
        $mapper = $orm->mapper(Article::class);

        foreach (range(1, 50) as $i) {
            $item = $mapper->createEntity();
            $item->setTitle($faker->sentence(2));
            $item->setImage($faker->imageUrl(800, 600));
            $item->setContent($faker->paragraph(40));
            $item->setState(random_int(0, 1));
            $item->setCreatedBy(1); // 現在沒有User，先填 1
            $item->setCategoryId(1); // 現在沒有分類，先填 1
            $item->setCreated($faker->dateTimeThisYear());
            $item->setImage($faker->imageUrl());
            $item->setParams(
                [
                    'show_date' => true,
                    'show_author' => false,
                ]
            );

            $article = $mapper->createOne($item);

            $seeder->outCounting();
        }
    }
);

$seeder->clear(
    static function () use ($seeder, $orm, $db) {
        $seeder->truncate(Article::class);
    }
);
