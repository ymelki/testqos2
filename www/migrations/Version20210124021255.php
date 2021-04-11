<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210124021255 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livraison CHANGE date date DATE NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bl DROP FOREIGN KEY FK_521636A9586DFF2');
        $this->addSql('DROP INDEX IDX_521636A9586DFF2 ON bl');
        $this->addSql('ALTER TABLE bl DROP designation');
        $this->addSql('ALTER TABLE livraison CHANGE date date DATETIME NOT NULL');
    }
}
