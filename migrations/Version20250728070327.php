<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250728070327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_detail (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', user_type VARCHAR(255) NOT NULL, user_id VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, name VARCHAR(180) NOT NULL, address VARCHAR(180) NOT NULL, phone_number VARCHAR(180) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD user_type VARCHAR(255) NOT NULL, ADD is_verified TINYINT(1) NOT NULL, CHANGE id id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_detail');
        $this->addSql('ALTER TABLE user DROP user_type, DROP is_verified, CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
