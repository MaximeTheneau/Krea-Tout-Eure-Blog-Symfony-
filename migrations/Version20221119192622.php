<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221119192622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE posts CHANGE img_post3 img_post3 VARCHAR(500) DEFAULT NULL, CHANGE img_post4 img_post4 VARCHAR(500) DEFAULT NULL, CHANGE img_post img_post VARCHAR(500) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE posts CHANGE img_post3 img_post3 VARCHAR(255) DEFAULT NULL, CHANGE img_post4 img_post4 VARCHAR(255) DEFAULT NULL, CHANGE img_post img_post LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\'');
    }
}
