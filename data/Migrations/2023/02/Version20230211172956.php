<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230211172956 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE travel_insurance ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE travel_insurance ADD CONSTRAINT FK_62D26B30A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_62D26B30A76ED395 ON travel_insurance (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE travel_insurance DROP FOREIGN KEY FK_62D26B30A76ED395');
        $this->addSql('DROP INDEX IDX_62D26B30A76ED395 ON travel_insurance');
        $this->addSql('ALTER TABLE travel_insurance DROP user_id');
    }
}
