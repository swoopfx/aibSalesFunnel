<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230430154642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE motor_insurance ADD motorCategory_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE motor_insurance ADD CONSTRAINT FK_FF7767A9276A8D72 FOREIGN KEY (motorCategory_id) REFERENCES motor_category (id)');
        $this->addSql('CREATE INDEX IDX_FF7767A9276A8D72 ON motor_insurance (motorCategory_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE motor_insurance DROP FOREIGN KEY FK_FF7767A9276A8D72');
        $this->addSql('DROP INDEX IDX_FF7767A9276A8D72 ON motor_insurance');
        $this->addSql('ALTER TABLE motor_insurance DROP motorCategory_id');
    }
}
