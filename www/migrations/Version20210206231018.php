<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210206231018 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bl ADD ordersa_id INT NOT NULL');
        $this->addSql('ALTER TABLE bl ADD CONSTRAINT FK_521636A9721EAB4A FOREIGN KEY (ordersa_id) REFERENCES ordersa (id)');
        $this->addSql('CREATE INDEX IDX_521636A9721EAB4A ON bl (ordersa_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bl DROP FOREIGN KEY FK_521636A9721EAB4A');
        $this->addSql('DROP INDEX IDX_521636A9721EAB4A ON bl');
        $this->addSql('ALTER TABLE bl DROP ordersa_id');
    }
}
