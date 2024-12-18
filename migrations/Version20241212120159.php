<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241212120159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD published_at DATE NOT NULL, DROP publiched_at');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CBE5A3312B36786B ON book (title)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_CBE5A3312B36786B ON book');
        $this->addSql('ALTER TABLE book ADD publiched_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP published_at');
    }
}
