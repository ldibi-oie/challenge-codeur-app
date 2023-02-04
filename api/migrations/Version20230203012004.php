<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230203012004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company CHANGE address address VARCHAR(100) DEFAULT NULL, CHANGE offerlist offerlist LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', CHANGE stripe_id stripe_id VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE freelance ADD user_id INT DEFAULT NULL, CHANGE birthday birthday VARCHAR(50) DEFAULT NULL, CHANGE freelancetypes freelancetypes LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
        $this->addSql('ALTER TABLE freelance ADD CONSTRAINT FK_48ABC6759D86650F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_48ABC6759D86650F ON freelance (user_id)');
        $this->addSql('ALTER TABLE media_object CHANGE file_path file_path VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE offer ADD category_id INT NOT NULL, ADD price INT NOT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_29D6873E12469DE2 ON offer (category_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media_object CHANGE file_path file_path VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE company CHANGE address address VARCHAR(100) DEFAULT \'NULL\', CHANGE offerlist offerlist LONGTEXT DEFAULT \'NULL\' COMMENT \'(DC2Type:array)\', CHANGE stripe_id stripe_id VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E12469DE2');
        $this->addSql('DROP INDEX IDX_29D6873E12469DE2 ON offer');
        $this->addSql('ALTER TABLE offer DROP category_id, DROP price');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE freelance DROP FOREIGN KEY FK_48ABC6759D86650F');
        $this->addSql('DROP INDEX UNIQ_48ABC6759D86650F ON freelance');
        $this->addSql('ALTER TABLE freelance DROP user_id, CHANGE birthday birthday VARCHAR(50) DEFAULT \'NULL\', CHANGE freelancetypes freelancetypes LONGTEXT DEFAULT \'NULL\' COMMENT \'(DC2Type:array)\'');
    }
}
