<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231222092129 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE repas ADD id_consomateur_id INT NOT NULL, ADD id_zone_id INT NOT NULL');
        $this->addSql('ALTER TABLE repas ADD CONSTRAINT FK_A8D351B32BDA02CC FOREIGN KEY (id_consomateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE repas ADD CONSTRAINT FK_A8D351B341B196DB FOREIGN KEY (id_zone_id) REFERENCES zone (id)');
        $this->addSql('CREATE INDEX IDX_A8D351B32BDA02CC ON repas (id_consomateur_id)');
        $this->addSql('CREATE INDEX IDX_A8D351B341B196DB ON repas (id_zone_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE repas DROP FOREIGN KEY FK_A8D351B32BDA02CC');
        $this->addSql('ALTER TABLE repas DROP FOREIGN KEY FK_A8D351B341B196DB');
        $this->addSql('DROP INDEX IDX_A8D351B32BDA02CC ON repas');
        $this->addSql('DROP INDEX IDX_A8D351B341B196DB ON repas');
        $this->addSql('ALTER TABLE repas DROP id_consomateur_id, DROP id_zone_id');
    }
}
