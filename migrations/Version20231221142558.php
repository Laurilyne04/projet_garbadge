<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231221142558 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE zone ADD responsable_id INT NOT NULL');
        $this->addSql('ALTER TABLE zone ADD CONSTRAINT FK_A0EBC00753C59D72 FOREIGN KEY (responsable_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_A0EBC00753C59D72 ON zone (responsable_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE zone DROP FOREIGN KEY FK_A0EBC00753C59D72');
        $this->addSql('DROP INDEX IDX_A0EBC00753C59D72 ON zone');
        $this->addSql('ALTER TABLE zone DROP responsable_id');
    }
}
