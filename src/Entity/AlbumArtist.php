<?php

namespace App\Entity;

use App\Repository\AlbumArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlbumArtistRepository::class)
 */
class AlbumArtist
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * > Relation ManyToOne bilatérale, c'est à dire :
     * > On peut accéder à nos Album depuis AlbumArtist
     * > On peut accéder aux AlbumArtist depuis Album
     *
     * @ORM\ManyToOne(targetEntity=Album::class, inversedBy="albumArtist")
     * @ORM\JoinColumn(nullable=false)
     */
    private $album;

    /**
     * > Relation ManyToOne bilatérale, c'est à dire :
     * > On peut accéder à nos Artist depuis AlbumArtist
     * > On peut accéder aux AlbumArtist depuis Artist
     *
     * @ORM\ManyToOne(targetEntity=Artist::class, inversedBy="albumArtists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $artist;

    /**
     * > Relation ManyToMany unilatérale, c'est à dire :
     * > On peut accéder à nos Genre depuis AlbumArtist
     * > On ne peut pas accéder aux AlbumArtist depuis Genre
     *
     * @ORM\ManyToMany(targetEntity=Genre::class)
     */
    private $genres;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlbum(): ?Album
    {
        return $this->album;
    }

    public function setAlbum(?Album $album): self
    {
        $this->album = $album;

        return $this;
    }

    public function getArtist(): ?Artist
    {
        return $this->artist;
    }

    public function setArtist(?Artist $artist): self
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * @return Collection|Genre[]
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres[] = $genre;
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }
}
