<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221202112548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'ALTER TABLE Fichier ADD seller_id INT DEFAULT NULL, ADD quantity INT NOT NULL'
        );
        $this->addSql(
            'ALTER TABLE Fichier ADD CONSTRAINT FK_D34A04AD8DE820D9 FOREIGN KEY (seller_id) REFERENCES user (id)'
        );
        $this->addSql(
            'CREATE INDEX IDX_D34A04AD8DE820D9 ON Fichier (seller_id)'
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(
            'ALTER TABLE Fichier DROP FOREIGN KEY FK_D34A04AD8DE820D9'
        );
        $this->addSql('DROP INDEX IDX_D34A04AD8DE820D9 ON Fichier');
        $this->addSql('ALTER TABLE Fichier DROP seller_id, DROP quantity');
    }
}
