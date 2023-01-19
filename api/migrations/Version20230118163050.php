<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230118163050 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, subscription_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, siretnumber INT DEFAULT NULL, role LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', email VARCHAR(50) NOT NULL, address VARCHAR(100) DEFAULT NULL, offerlist LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_4FBF094F9A1887DC (subscription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE freelance (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, surname VARCHAR(50) NOT NULL, siretnumber INT DEFAULT NULL, role LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', birthday VARCHAR(50) DEFAULT NULL, email VARCHAR(50) NOT NULL, isverified TINYINT(1) NOT NULL, password VARCHAR(50) NOT NULL, freelancetypes LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', cvlink VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE keyword (id INT AUTO_INCREMENT NOT NULL, offer_id INT DEFAULT NULL, freelance_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_5A93713B53C674EE (offer_id), INDEX IDX_5A93713BE8DF656B (freelance_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, company_id INT NOT NULL, title VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_29D6873E979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE offer_freelance (offer_id INT NOT NULL, freelance_id INT NOT NULL, INDEX IDX_EB6EBBB153C674EE (offer_id), INDEX IDX_EB6EBBB1E8DF656B (freelance_id), PRIMARY KEY(offer_id, freelance_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subcription (id INT AUTO_INCREMENT NOT NULL, subcriptiontype VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F9A1887DC FOREIGN KEY (subscription_id) REFERENCES subcription (id)');
        $this->addSql('ALTER TABLE keyword ADD CONSTRAINT FK_5A93713B53C674EE FOREIGN KEY (offer_id) REFERENCES offer (id)');
        $this->addSql('ALTER TABLE keyword ADD CONSTRAINT FK_5A93713BE8DF656B FOREIGN KEY (freelance_id) REFERENCES freelance (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE offer_freelance ADD CONSTRAINT FK_EB6EBBB153C674EE FOREIGN KEY (offer_id) REFERENCES offer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE offer_freelance ADD CONSTRAINT FK_EB6EBBB1E8DF656B FOREIGN KEY (freelance_id) REFERENCES freelance (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F9A1887DC');
        $this->addSql('ALTER TABLE keyword DROP FOREIGN KEY FK_5A93713B53C674EE');
        $this->addSql('ALTER TABLE keyword DROP FOREIGN KEY FK_5A93713BE8DF656B');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E979B1AD6');
        $this->addSql('ALTER TABLE offer_freelance DROP FOREIGN KEY FK_EB6EBBB153C674EE');
        $this->addSql('ALTER TABLE offer_freelance DROP FOREIGN KEY FK_EB6EBBB1E8DF656B');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE freelance');
        $this->addSql('DROP TABLE keyword');
        $this->addSql('DROP TABLE offer');
        $this->addSql('DROP TABLE offer_freelance');
        $this->addSql('DROP TABLE subcription');
        $this->addSql('DROP TABLE user');
    }
}
