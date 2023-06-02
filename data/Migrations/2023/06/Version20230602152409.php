<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230602152409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_category (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD userCategory_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64950F624A1 FOREIGN KEY (userCategory_id) REFERENCES user_category (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64950F624A1 ON user (userCategory_id)');
        $this->addSql('ALTER TABLE voters_card_data ADD lastname VARCHAR(255) DEFAULT NULL, CHANGE fullname firstname VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64950F624A1');
        $this->addSql('DROP TABLE user_category');
        $this->addSql('DROP INDEX IDX_8D93D64950F624A1 ON user');
        $this->addSql('ALTER TABLE user DROP userCategory_id');
        $this->addSql('ALTER TABLE voters_card_data ADD fullname VARCHAR(255) DEFAULT NULL, DROP firstname, DROP lastname');
    }
}
