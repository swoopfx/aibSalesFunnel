<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230228005835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE motor_insurance ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE motor_insurance ADD CONSTRAINT FK_FF7767A9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_FF7767A9A76ED395 ON motor_insurance (user_id)');
        $this->addSql('ALTER TABLE uploads DROP is_confirmed');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE motor_insurance DROP FOREIGN KEY FK_FF7767A9A76ED395');
        $this->addSql('DROP INDEX IDX_FF7767A9A76ED395 ON motor_insurance');
        $this->addSql('ALTER TABLE motor_insurance DROP user_id');
        $this->addSql('ALTER TABLE uploads ADD is_confirmed TINYINT(1) DEFAULT NULL');
    }
}
