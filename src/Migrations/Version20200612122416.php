<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200612122416 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE amenagement (id INT AUTO_INCREMENT NOT NULL, lots_id INT DEFAULT NULL, services_id INT DEFAULT NULL, date_amenagement DATE NOT NULL, INDEX IDX_4FF55421C400113F (lots_id), INDEX IDX_4FF55421AEF5A6C1 (services_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lots (id INT AUTO_INCREMENT NOT NULL, superficie DOUBLE PRECISION NOT NULL, region VARCHAR(255) NOT NULL, etat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE amenagement ADD CONSTRAINT FK_4FF55421C400113F FOREIGN KEY (lots_id) REFERENCES lots (id)');
        $this->addSql('ALTER TABLE amenagement ADD CONSTRAINT FK_4FF55421AEF5A6C1 FOREIGN KEY (services_id) REFERENCES services (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE amenagement DROP FOREIGN KEY FK_4FF55421C400113F');
        $this->addSql('ALTER TABLE amenagement DROP FOREIGN KEY FK_4FF55421AEF5A6C1');
        $this->addSql('DROP TABLE amenagement');
        $this->addSql('DROP TABLE lots');
        $this->addSql('DROP TABLE services');
    }
}
