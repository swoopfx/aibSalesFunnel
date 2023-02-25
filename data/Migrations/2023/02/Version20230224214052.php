<?php

declare(strict_types=1);

namespace Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230224214052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE available_service (id INT AUTO_INCREMENT NOT NULL, serviceName VARCHAR(255) NOT NULL, createdOn DATETIME NOT NULL, updatedOn DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE availaible_service_insurer (available_service_id INT NOT NULL, insurer_id INT NOT NULL, INDEX IDX_EDFD571D73534C9E (available_service_id), INDEX IDX_EDFD571D895854C7 (insurer_id), PRIMARY KEY(available_service_id, insurer_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, country_name VARCHAR(128) DEFAULT NULL, iso_code_2 VARCHAR(2) DEFAULT NULL, iso_code_3 VARCHAR(6) DEFAULT NULL, address_format LONGTEXT DEFAULT NULL, postcode_required TINYINT(1) DEFAULT NULL, status TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(45) DEFAULT NULL, code VARCHAR(10) DEFAULT NULL, iso_code VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, gender VARCHAR(45) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE insurer (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, alias VARCHAR(255) NOT NULL, isActive TINYINT(1) NOT NULL, insurerUid VARCHAR(255) NOT NULL, logo VARCHAR(255) NOT NULL, createdOn DATETIME NOT NULL, UNIQUE INDEX UNIQ_A2DB411F84CFD111 (insurerUid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marine_cargo_insurance (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, cargoUid VARCHAR(255) NOT NULL, createdOn DATETIME NOT NULL, updatedOn DATETIME NOT NULL, INDEX IDX_A6DBD797A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motor_insurance (id INT AUTO_INCREMENT NOT NULL, currency_id INT DEFAULT NULL, valueOfCar VARCHAR(255) DEFAULT NULL, createdOn DATETIME NOT NULL, updatedOn DATETIME NOT NULL, coverType_id INT DEFAULT NULL, vehicleLicense_id INT DEFAULT NULL, proofOfOwnership_id INT DEFAULT NULL, meansOfId_id INT DEFAULT NULL, INDEX IDX_FF7767A9737ED7C1 (coverType_id), INDEX IDX_FF7767A9B37177D4 (vehicleLicense_id), INDEX IDX_FF7767A948322956 (proofOfOwnership_id), INDEX IDX_FF7767A970B99D61 (meansOfId_id), INDEX IDX_FF7767A938248176 (currency_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicle_images (motor_insurance_id INT NOT NULL, upload_id INT NOT NULL, INDEX IDX_49C1BFB95435BADF (motor_insurance_id), INDEX IDX_49C1BFB9CCCFBA31 (upload_id), PRIMARY KEY(motor_insurance_id, upload_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE motor_insurance_covertype (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles_parents (role_id INT NOT NULL, parent_id INT NOT NULL, INDEX IDX_C70E6B91D60322AC (role_id), INDEX IDX_C70E6B91727ACA70 (parent_id), PRIMARY KEY(role_id, parent_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE selected_service (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, insurer_id INT DEFAULT NULL, createdOn DATETIME DEFAULT NULL, transaction DATETIME DEFAULT NULL, isActive TINYINT(1) DEFAULT 1 NOT NULL, updatedOn DATETIME NOT NULL, selectedService_id INT DEFAULT NULL, INDEX IDX_9D9E44CA76ED395 (user_id), INDEX IDX_9D9E44CB7E218C0 (selectedService_id), INDEX IDX_9D9E44C895854C7 (insurer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, transactionRef VARCHAR(255) NOT NULL, transactionUid VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_723705D165A3767C (transactionRef), UNIQUE INDEX UNIQ_723705D122574ED9 (transactionUid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travel_insurance (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, travelUid VARCHAR(255) NOT NULL, dob DATE DEFAULT NULL, updatedOn DATETIME NOT NULL, createdOn DATETIME NOT NULL, INDEX IDX_62D26B30A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travel_insurance_list (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travel_list_category (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE uploads (id INT AUTO_INCREMENT NOT NULL, doc_name VARCHAR(200) DEFAULT NULL, doc_url VARCHAR(500) DEFAULT NULL, is_confirmed TINYINT(1) DEFAULT NULL, created_on DATETIME DEFAULT NULL, updated_on DATETIME DEFAULT NULL, is_hidden TINYINT(1) DEFAULT NULL, mime_type VARCHAR(100) DEFAULT NULL, doc_ext VARCHAR(45) DEFAULT NULL, doc_code VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, fullname VARCHAR(255) DEFAULT NULL, phonenumber VARCHAR(30) NOT NULL, email VARCHAR(30) NOT NULL, password VARCHAR(100) NOT NULL, registration_date DATETIME DEFAULT NULL, registration_token VARCHAR(32) DEFAULT NULL, email_confirmed TINYINT(1) NOT NULL, createdOn DATETIME DEFAULT NULL, updatedOn DATETIME DEFAULT NULL, Uuid VARCHAR(255) NOT NULL, isActive TINYINT(1) DEFAULT 0 NOT NULL, UNIQUE INDEX UNIQ_8D93D649EFF286D2 (phonenumber), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zone (id INT AUTO_INCREMENT NOT NULL, country_id INT DEFAULT NULL, zone_name VARCHAR(128) NOT NULL, code VARCHAR(32) NOT NULL, status INT NOT NULL, INDEX FK_zone_country_idx (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE availaible_service_insurer ADD CONSTRAINT FK_EDFD571D73534C9E FOREIGN KEY (available_service_id) REFERENCES available_service (id)');
        $this->addSql('ALTER TABLE availaible_service_insurer ADD CONSTRAINT FK_EDFD571D895854C7 FOREIGN KEY (insurer_id) REFERENCES insurer (id)');
        $this->addSql('ALTER TABLE marine_cargo_insurance ADD CONSTRAINT FK_A6DBD797A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE motor_insurance ADD CONSTRAINT FK_FF7767A9737ED7C1 FOREIGN KEY (coverType_id) REFERENCES motor_insurance_covertype (id)');
        $this->addSql('ALTER TABLE motor_insurance ADD CONSTRAINT FK_FF7767A9B37177D4 FOREIGN KEY (vehicleLicense_id) REFERENCES uploads (id)');
        $this->addSql('ALTER TABLE motor_insurance ADD CONSTRAINT FK_FF7767A948322956 FOREIGN KEY (proofOfOwnership_id) REFERENCES uploads (id)');
        $this->addSql('ALTER TABLE motor_insurance ADD CONSTRAINT FK_FF7767A970B99D61 FOREIGN KEY (meansOfId_id) REFERENCES uploads (id)');
        $this->addSql('ALTER TABLE motor_insurance ADD CONSTRAINT FK_FF7767A938248176 FOREIGN KEY (currency_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE vehicle_images ADD CONSTRAINT FK_49C1BFB95435BADF FOREIGN KEY (motor_insurance_id) REFERENCES motor_insurance (id)');
        $this->addSql('ALTER TABLE vehicle_images ADD CONSTRAINT FK_49C1BFB9CCCFBA31 FOREIGN KEY (upload_id) REFERENCES uploads (id)');
        $this->addSql('ALTER TABLE roles_parents ADD CONSTRAINT FK_C70E6B91D60322AC FOREIGN KEY (role_id) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE roles_parents ADD CONSTRAINT FK_C70E6B91727ACA70 FOREIGN KEY (parent_id) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE selected_service ADD CONSTRAINT FK_9D9E44CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE selected_service ADD CONSTRAINT FK_9D9E44CB7E218C0 FOREIGN KEY (selectedService_id) REFERENCES available_service (id)');
        $this->addSql('ALTER TABLE selected_service ADD CONSTRAINT FK_9D9E44C895854C7 FOREIGN KEY (insurer_id) REFERENCES insurer (id)');
        $this->addSql('ALTER TABLE travel_insurance ADD CONSTRAINT FK_62D26B30A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES roles (id)');
        $this->addSql('ALTER TABLE zone ADD CONSTRAINT FK_A0EBC007F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE availaible_service_insurer DROP FOREIGN KEY FK_EDFD571D73534C9E');
        $this->addSql('ALTER TABLE availaible_service_insurer DROP FOREIGN KEY FK_EDFD571D895854C7');
        $this->addSql('ALTER TABLE marine_cargo_insurance DROP FOREIGN KEY FK_A6DBD797A76ED395');
        $this->addSql('ALTER TABLE motor_insurance DROP FOREIGN KEY FK_FF7767A9737ED7C1');
        $this->addSql('ALTER TABLE motor_insurance DROP FOREIGN KEY FK_FF7767A9B37177D4');
        $this->addSql('ALTER TABLE motor_insurance DROP FOREIGN KEY FK_FF7767A948322956');
        $this->addSql('ALTER TABLE motor_insurance DROP FOREIGN KEY FK_FF7767A970B99D61');
        $this->addSql('ALTER TABLE motor_insurance DROP FOREIGN KEY FK_FF7767A938248176');
        $this->addSql('ALTER TABLE vehicle_images DROP FOREIGN KEY FK_49C1BFB95435BADF');
        $this->addSql('ALTER TABLE vehicle_images DROP FOREIGN KEY FK_49C1BFB9CCCFBA31');
        $this->addSql('ALTER TABLE roles_parents DROP FOREIGN KEY FK_C70E6B91D60322AC');
        $this->addSql('ALTER TABLE roles_parents DROP FOREIGN KEY FK_C70E6B91727ACA70');
        $this->addSql('ALTER TABLE selected_service DROP FOREIGN KEY FK_9D9E44CA76ED395');
        $this->addSql('ALTER TABLE selected_service DROP FOREIGN KEY FK_9D9E44CB7E218C0');
        $this->addSql('ALTER TABLE selected_service DROP FOREIGN KEY FK_9D9E44C895854C7');
        $this->addSql('ALTER TABLE travel_insurance DROP FOREIGN KEY FK_62D26B30A76ED395');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('ALTER TABLE zone DROP FOREIGN KEY FK_A0EBC007F92F3E70');
        $this->addSql('DROP TABLE available_service');
        $this->addSql('DROP TABLE availaible_service_insurer');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP TABLE insurer');
        $this->addSql('DROP TABLE marine_cargo_insurance');
        $this->addSql('DROP TABLE motor_insurance');
        $this->addSql('DROP TABLE vehicle_images');
        $this->addSql('DROP TABLE motor_insurance_covertype');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE roles_parents');
        $this->addSql('DROP TABLE selected_service');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE travel_insurance');
        $this->addSql('DROP TABLE travel_insurance_list');
        $this->addSql('DROP TABLE travel_list_category');
        $this->addSql('DROP TABLE uploads');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE zone');
    }
}
