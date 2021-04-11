<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210206201332 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bl ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bl ADD CONSTRAINT FK_521636A982EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_521636A982EA2E54 ON bl (commande_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bl DROP FOREIGN KEY FK_521636A982EA2E54');
        $this->addSql('DROP INDEX IDX_521636A982EA2E54 ON bl');
        $this->addSql('ALTER TABLE bl DROP commande_id');
    }
}
