<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230602083621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE passport_data (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, uuid VARCHAR(255) NOT NULL, passportId VARCHAR(255) NOT NULL, passportNo VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, middlename VARCHAR(255) DEFAULT NULL, birthdate VARCHAR(255) DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, issuedAt VARCHAR(255) DEFAULT NULL, issuedDate VARCHAR(255) DEFAULT NULL, expiryDate VARCHAR(255) DEFAULT NULL, createdOn DATETIME NOT NULL, updatedOn DATETIME NOT NULL, INDEX IDX_58119B7AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profile (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE v_nin_data (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, uuid VARCHAR(255) NOT NULL, vNinId VARCHAR(255) DEFAULT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, middlename VARCHAR(255) DEFAULT NULL, birthdate VARCHAR(255) DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, vNin VARCHAR(255) DEFAULT NULL, photo LONGTEXT DEFAULT NULL, createdOn DATETIME NOT NULL, updatedOn DATETIME NOT NULL, INDEX IDX_6A73B2FEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voters_card_data (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, uuid VARCHAR(255) NOT NULL, votersId VARCHAR(255) DEFAULT NULL, vin VARCHAR(255) DEFAULT NULL, fullname VARCHAR(255) DEFAULT NULL, occupation VARCHAR(255) DEFAULT NULL, birthdate VARCHAR(255) DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, createdOn DATETIME NOT NULL, updatedOn DATETIME NOT NULL, INDEX IDX_D68251F6A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE passport_data ADD CONSTRAINT FK_58119B7AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE v_nin_data ADD CONSTRAINT FK_6A73B2FEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE voters_card_data ADD CONSTRAINT FK_D68251F6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD identifier_id INT DEFAULT NULL, ADD isIdentifier TINYINT(1) DEFAULT 0');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649EF794DF6 FOREIGN KEY (identifier_id) REFERENCES identfication (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649EF794DF6 ON user (identifier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE passport_data DROP FOREIGN KEY FK_58119B7AA76ED395');
        $this->addSql('ALTER TABLE v_nin_data DROP FOREIGN KEY FK_6A73B2FEA76ED395');
        $this->addSql('ALTER TABLE voters_card_data DROP FOREIGN KEY FK_D68251F6A76ED395');
        $this->addSql('DROP TABLE passport_data');
        $this->addSql('DROP TABLE profile');
        $this->addSql('DROP TABLE v_nin_data');
        $this->addSql('DROP TABLE voters_card_data');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649EF794DF6');
        $this->addSql('DROP INDEX IDX_8D93D649EF794DF6 ON user');
        $this->addSql('ALTER TABLE user DROP identifier_id, DROP isIdentifier');
    }
}
