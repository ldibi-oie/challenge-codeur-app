<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230124111554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, subscription_id INT NOT NULL, stripe_id VARCHAR(255) NOT NULL, amount_paid INT NOT NULL, number VARCHAR(255) NOT NULL, hosted_invoice_url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_906517449A1887DC (subscription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE invoice ADD CONSTRAINT FK_906517449A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id)');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F9A1887DC');
        $this->addSql('DROP INDEX UNIQ_4FBF094F9A1887DC ON company');
        $this->addSql('ALTER TABLE company DROP subscription_id');
        $this->addSql('ALTER TABLE media_object ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE subscription ADD company_id INT NOT NULL');
        $this->addSql('ALTER TABLE subscription ADD CONSTRAINT FK_A3C664D3979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_A3C664D3979B1AD6 ON subscription (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE invoice DROP FOREIGN KEY FK_906517449A1887DC');
        $this->addSql('DROP TABLE invoice');
        $this->addSql('ALTER TABLE media_object DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE company ADD subscription_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F9A1887DC FOREIGN KEY (subscription_id) REFERENCES subscription (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4FBF094F9A1887DC ON company (subscription_id)');
        $this->addSql('ALTER TABLE subscription DROP FOREIGN KEY FK_A3C664D3979B1AD6');
        $this->addSql('DROP INDEX IDX_A3C664D3979B1AD6 ON subscription');
        $this->addSql('ALTER TABLE subscription DROP company_id');
    }
}
