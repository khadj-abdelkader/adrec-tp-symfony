<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201103659 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album_song (album_id INT NOT NULL, song_id INT NOT NULL, INDEX IDX_57E658E11137ABCF (album_id), INDEX IDX_57E658E1A0BDB2F3 (song_id), PRIMARY KEY(album_id, song_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE album_song ADD CONSTRAINT FK_57E658E11137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album_song ADD CONSTRAINT FK_57E658E1A0BDB2F3 FOREIGN KEY (song_id) REFERENCES song (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist DROP nationality');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE album_song');
        $this->addSql('ALTER TABLE artist ADD nationality VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
