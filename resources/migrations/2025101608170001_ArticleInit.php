<?php

declare(strict_types=1);

namespace App\Migration;

use App\Entity\Article;
use Windwalker\Core\Migration\AbstractMigration;
use Windwalker\Core\Migration\MigrateUp;
use Windwalker\Core\Migration\MigrateDown;
use Windwalker\Database\Schema\Schema;

return new /** 2025101608170001_ArticleInit */ class extends AbstractMigration {
    #[MigrateUp]
    public function up(): void
    {
        $this->createTable(
            Article::class,
            function (Schema $schema) {
                $schema->primary('id');
                $schema->integer('category_id');
                $schema->varchar('title');
                $schema->varchar('image');
                $schema->tinyint('state');
                $schema->longtext('content');
                $schema->datetime('created');
                $schema->integer('created_by');
                $schema->json('params');

                $schema->addIndex('category_id');
                $schema->addIndex('created_by');
            }
        );
    }

    #[MigrateDown]
    public function down(): void
    {
        $this->dropTables(Article::class);
    }
};
