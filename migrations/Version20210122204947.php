<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210122204947 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A4C2885D7');
        $this->addSql('DROP INDEX IDX_E01FBE6A4C2885D7 ON images');
        $this->addSql('ALTER TABLE images CHANGE annonces_id annonce_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A8805AB2F FOREIGN KEY (annonce_id) REFERENCES ad (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6A8805AB2F ON images (annonce_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A8805AB2F');
        $this->addSql('DROP INDEX IDX_E01FBE6A8805AB2F ON images');
        $this->addSql('ALTER TABLE images CHANGE annonce_id annonces_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A4C2885D7 FOREIGN KEY (annonces_id) REFERENCES ad (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6A4C2885D7 ON images (annonces_id)');
    }
}
