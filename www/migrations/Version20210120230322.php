<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210120230322 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bl ADD livraison_id INT NOT NULL');
        $this->addSql('ALTER TABLE bl ADD CONSTRAINT FK_521636A98E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('CREATE INDEX IDX_521636A98E54FB25 ON bl (livraison_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bl DROP FOREIGN KEY FK_521636A98E54FB25');
        $this->addSql('DROP INDEX IDX_521636A98E54FB25 ON bl');
        $this->addSql('ALTER TABLE bl DROP livraison_id');
    }
}
