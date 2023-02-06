<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230202233810 extends AbstractMigration
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
        $this->addSql('ALTER TABLE freelance ADD CONSTRAINT FK_48ABC675A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_48ABC675A76ED395 ON freelance (user_id)');
        $this->addSql('ALTER TABLE media_object CHANGE file_path file_path VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE media_object CHANGE file_path file_path VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE company CHANGE address address VARCHAR(100) DEFAULT \'NULL\', CHANGE offerlist offerlist LONGTEXT DEFAULT \'NULL\' COMMENT \'(DC2Type:array)\', CHANGE stripe_id stripe_id VARCHAR(255) DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE freelance DROP FOREIGN KEY FK_48ABC675A76ED395');
        $this->addSql('DROP INDEX IDX_48ABC675A76ED395 ON freelance');
        $this->addSql('ALTER TABLE freelance DROP user_id, CHANGE birthday birthday VARCHAR(50) DEFAULT \'NULL\', CHANGE freelancetypes freelancetypes LONGTEXT DEFAULT \'NULL\' COMMENT \'(DC2Type:array)\'');
    }
}
