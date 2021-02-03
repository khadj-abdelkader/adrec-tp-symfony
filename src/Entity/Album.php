<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlbumRepository::class)
 */
class Album
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $publishedYear;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * > Relation ManyToMany bilatérale, c'est à dire :
     * > On peut accéder à nos Song depuis Album
     * > On peut accéder aux Album depuis Song
     *
     * @ORM\ManyToMany(targetEntity=Song::class, inversedBy="album")
     */
    private $songs;

    /**
     * > Relation OneToMany bilatérale, c'est à dire :
     * > On peut accéder à nos AlbumArtist depuis Album
     * > On peut accéder aux Album depuis AlbumArtist
     *
     * @ORM\OneToMany(targetEntity=AlbumArtist::class, mappedBy="album", orphanRemoval=true)
     */
    private $albumArtist;

    public function __construct()
    {
        $this->songs = new ArrayCollection();
        $this->albumArtist = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPublishedYear(): ?int
    {
        return $this->publishedYear;
    }

    public function setPublishedYear(?int $publishedYear): self
    {
        $this->publishedYear = $publishedYear;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|Song[]
     */
    public function getSongs(): Collection
    {
        return $this->songs;
    }

    public function addSong(Song $song): self
    {
        if (!$this->songs->contains($song)) {
            $this->songs[] = $song;
            $song->addAlbum($this);
        }

        return $this;
    }

    public function removeSong(Song $song): self
    {
        if ($this->songs->removeElement($song)) {
            $song->removeAlbum($this);
        }

        return $this;
    }

    /**
     * @return Collection|AlbumArtist[]
     */
    public function getAlbumArtist(): Collection
    {
        return $this->albumArtist;
    }

    public function addAlbumArtist(AlbumArtist $albumArtist): self
    {
        if (!$this->albumArtist->contains($albumArtist)) {
            $this->albumArtist[] = $albumArtist;
            $albumArtist->setAlbum($this);
        }

        return $this;
    }

    public function removeAlbumArtist(AlbumArtist $albumArtist): self
    {
        if ($this->albumArtist->removeElement($albumArtist)) {
            // set the owning side to null (unless already changed)
            if ($albumArtist->getAlbum() === $this) {
                $albumArtist->setAlbum(null);
            }
        }

        return $this;
    }
}
