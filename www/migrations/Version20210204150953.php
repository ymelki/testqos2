<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210204150953 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bl CHANGE livraison_id livraison_id INT NOT NULL, CHANGE user_info_id user_info_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD magasin VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bl CHANGE livraison_id livraison_id INT DEFAULT NULL, CHANGE user_info_id user_info_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` DROP magasin');
    }
}
