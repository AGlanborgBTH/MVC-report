<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220523171726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE history (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, login_id_id INTEGER DEFAULT NULL, acts VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_27BA704B793459C3 ON history (login_id_id)');
        $this->addSql('CREATE TABLE logins (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_name VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, money INTEGER NOT NULL, admin BOOLEAN NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE history');
        $this->addSql('DROP TABLE logins');
    }
}
