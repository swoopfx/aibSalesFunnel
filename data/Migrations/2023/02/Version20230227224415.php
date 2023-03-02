<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230227224415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE settings (id INT AUTO_INCREMENT NOT NULL, companyName VARCHAR(255) NOT NULL, companyEmail VARCHAR(255) NOT NULL, thirdPartyRate VARCHAR(255) NOT NULL, comprehensiveRate VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE motor_insurance ADD frontImage_id INT DEFAULT NULL, ADD backImage_id INT DEFAULT NULL, ADD dashboardImage_id INT DEFAULT NULL, ADD interiorImage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE motor_insurance ADD CONSTRAINT FK_FF7767A969AF00DC FOREIGN KEY (frontImage_id) REFERENCES uploads (id)');
        $this->addSql('ALTER TABLE motor_insurance ADD CONSTRAINT FK_FF7767A96BF14558 FOREIGN KEY (backImage_id) REFERENCES uploads (id)');
        $this->addSql('ALTER TABLE motor_insurance ADD CONSTRAINT FK_FF7767A917F746B FOREIGN KEY (dashboardImage_id) REFERENCES uploads (id)');
        $this->addSql('ALTER TABLE motor_insurance ADD CONSTRAINT FK_FF7767A9FB735BA3 FOREIGN KEY (interiorImage_id) REFERENCES uploads (id)');
        $this->addSql('CREATE INDEX IDX_FF7767A969AF00DC ON motor_insurance (frontImage_id)');
        $this->addSql('CREATE INDEX IDX_FF7767A96BF14558 ON motor_insurance (backImage_id)');
        $this->addSql('CREATE INDEX IDX_FF7767A917F746B ON motor_insurance (dashboardImage_id)');
        $this->addSql('CREATE INDEX IDX_FF7767A9FB735BA3 ON motor_insurance (interiorImage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE settings');
        $this->addSql('ALTER TABLE motor_insurance DROP FOREIGN KEY FK_FF7767A969AF00DC');
        $this->addSql('ALTER TABLE motor_insurance DROP FOREIGN KEY FK_FF7767A96BF14558');
        $this->addSql('ALTER TABLE motor_insurance DROP FOREIGN KEY FK_FF7767A917F746B');
        $this->addSql('ALTER TABLE motor_insurance DROP FOREIGN KEY FK_FF7767A9FB735BA3');
        $this->addSql('DROP INDEX IDX_FF7767A969AF00DC ON motor_insurance');
        $this->addSql('DROP INDEX IDX_FF7767A96BF14558 ON motor_insurance');
        $this->addSql('DROP INDEX IDX_FF7767A917F746B ON motor_insurance');
        $this->addSql('DROP INDEX IDX_FF7767A9FB735BA3 ON motor_insurance');
        $this->addSql('ALTER TABLE motor_insurance DROP frontImage_id, DROP backImage_id, DROP dashboardImage_id, DROP interiorImage_id');
    }
}
