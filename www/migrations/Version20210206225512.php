<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210206225512 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tcmd (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bl ADD commandes_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bl ADD CONSTRAINT FK_521636A98BF5C2E6 FOREIGN KEY (commandes_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_521636A98BF5C2E6 ON bl (commandes_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE tcmd');
        $this->addSql('ALTER TABLE bl DROP FOREIGN KEY FK_521636A98BF5C2E6');
        $this->addSql('DROP INDEX IDX_521636A98BF5C2E6 ON bl');
        $this->addSql('ALTER TABLE bl DROP commandes_id');
    }
}
