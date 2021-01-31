<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210131162144 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED582714C098');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED5867BDECF7');
        $this->addSql('ALTER TABLE ad DROP FOREIGN KEY FK_77E0ED58FB3C5D62');
        $this->addSql('DROP INDEX UNIQ_77E0ED582714C098 ON ad');
        $this->addSql('DROP INDEX UNIQ_77E0ED5867BDECF7 ON ad');
        $this->addSql('DROP INDEX UNIQ_77E0ED58FB3C5D62 ON ad');
        $this->addSql('ALTER TABLE ad DROP image_first_id, DROP image_second_id, DROP image_third_id');
        $this->addSql('ALTER TABLE images ADD annonce_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A8805AB2F FOREIGN KEY (annonce_id) REFERENCES ad (id)');
        $this->addSql('CREATE INDEX IDX_E01FBE6A8805AB2F ON images (annonce_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ad ADD image_first_id INT DEFAULT NULL, ADD image_second_id INT DEFAULT NULL, ADD image_third_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED582714C098 FOREIGN KEY (image_second_id) REFERENCES images (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED5867BDECF7 FOREIGN KEY (image_first_id) REFERENCES images (id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58FB3C5D62 FOREIGN KEY (image_third_id) REFERENCES images (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_77E0ED582714C098 ON ad (image_second_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_77E0ED5867BDECF7 ON ad (image_first_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_77E0ED58FB3C5D62 ON ad (image_third_id)');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A8805AB2F');
        $this->addSql('DROP INDEX IDX_E01FBE6A8805AB2F ON images');
        $this->addSql('ALTER TABLE images DROP annonce_id');
    }
}
