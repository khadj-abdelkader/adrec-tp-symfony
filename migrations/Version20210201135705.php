<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210201135705 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album_artist_genre (album_artist_id INT NOT NULL, genre_id INT NOT NULL, INDEX IDX_8F119A92DAB904B5 (album_artist_id), INDEX IDX_8F119A924296D31F (genre_id), PRIMARY KEY(album_artist_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE album_artist_genre ADD CONSTRAINT FK_8F119A92DAB904B5 FOREIGN KEY (album_artist_id) REFERENCES album_artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album_artist_genre ADD CONSTRAINT FK_8F119A924296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE album_artist_genre');
    }
}
