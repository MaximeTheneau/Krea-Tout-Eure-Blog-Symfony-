<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221205093853 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image_placeholder (id INT AUTO_INCREMENT NOT NULL, img_base64 VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pages (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(70) NOT NULL, subtitle VARCHAR(70) DEFAULT NULL, contents VARCHAR(750) NOT NULL, contents2 VARCHAR(750) DEFAULT NULL, slug VARCHAR(255) NOT NULL, img_header VARCHAR(800) DEFAULT NULL, img_thumbnail VARCHAR(800) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE posts (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(70) NOT NULL, contents VARCHAR(750) DEFAULT NULL, contents2 VARCHAR(750) DEFAULT NULL, subtitle VARCHAR(70) DEFAULT NULL, slug VARCHAR(255) NOT NULL, img_post JSON NOT NULL, img_post2 JSON DEFAULT NULL, img_post3 JSON DEFAULT NULL, img_post4 JSON DEFAULT NULL, img_thumbnail VARCHAR(500) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE image_placeholder');
        $this->addSql('DROP TABLE pages');
        $this->addSql('DROP TABLE posts');
        $this->addSql('DROP TABLE user');
    }
}
