<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241123104926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etablissement ADD type_etablissement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etablissement ADD CONSTRAINT FK_20FD592CA8FC9399 FOREIGN KEY (type_etablissement_id) REFERENCES type_etablissement (id)');
        $this->addSql('CREATE INDEX IDX_20FD592CA8FC9399 ON etablissement (type_etablissement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etablissement DROP FOREIGN KEY FK_20FD592CA8FC9399');
        $this->addSql('DROP INDEX IDX_20FD592CA8FC9399 ON etablissement');
        $this->addSql('ALTER TABLE etablissement DROP type_etablissement_id');
    }
}
