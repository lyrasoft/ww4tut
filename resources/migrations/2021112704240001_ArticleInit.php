<?php

/**
 * Part of Windwalker project.
 *
 * @copyright  Copyright (C) 2021.
 * @license    __LICENSE__
 */

declare(strict_types=1);

namespace App\Migration;

use App\Entity\Article;
use Windwalker\Core\Console\ConsoleApplication;
use Windwalker\Core\Migration\Migration;
use Windwalker\Database\Schema\Schema;

/**
 * Migration UP: 2021112704240001_ArticleInit.
 *
 * @var Migration          $mig
 * @var ConsoleApplication $app
 */
$mig->up(
    static function () use ($mig) {
        $mig->createTable(Article::class, function (Schema $schema) {
            $schema->primary('id');
            $schema->integer('category_id');
            $schema->varchar('title');
            $schema->varchar('image');
            $schema->tinyint('state');
            $schema->text('content');
            $schema->datetime('created');
            $schema->integer('created_by');
            $schema->json('params');

            $schema->addIndex('category_id');
            $schema->addIndex('created_by');
        });
    }
);

/**
 * Migration DOWN.
 */
$mig->down(
    static function () use ($mig) {
        $mig->dropTables(Article::class);
    }
);
