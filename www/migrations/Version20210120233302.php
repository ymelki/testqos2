<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210120233302 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bl (id INT AUTO_INCREMENT NOT NULL, livraison_id INT DEFAULT NULL, user_info_id INT DEFAULT NULL, produit VARCHAR(255) NOT NULL, quantite INT NOT NULL, INDEX IDX_521636A98E54FB25 (livraison_id), INDEX IDX_521636A9586DFF2 (user_info_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bl ADD CONSTRAINT FK_521636A98E54FB25 FOREIGN KEY (livraison_id) REFERENCES livraison (id)');
        $this->addSql('ALTER TABLE bl ADD CONSTRAINT FK_521636A9586DFF2 FOREIGN KEY (user_info_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE bl');
    }
}
