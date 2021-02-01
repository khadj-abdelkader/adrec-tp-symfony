<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArtistRepository::class)
 */
class Artist
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
    private $beginningYear;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class)
     */
    private $country;

    /**
     * @ORM\OneToMany(targetEntity=AlbumArtist::class, mappedBy="artist", orphanRemoval=true)
     */
    private $albumArtists;

    public function __construct()
    {
        $this->albumArtists = new ArrayCollection();
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

    public function getBeginningYear(): ?int
    {
        return $this->beginningYear;
    }

    public function setBeginningYear(?int $beginningYear): self
    {
        $this->beginningYear = $beginningYear;

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection|AlbumArtist[]
     */
    public function getAlbumArtists(): Collection
    {
        return $this->albumArtists;
    }

    public function addAlbumArtist(AlbumArtist $albumArtist): self
    {
        if (!$this->albumArtists->contains($albumArtist)) {
            $this->albumArtists[] = $albumArtist;
            $albumArtist->setArtist($this);
        }

        return $this;
    }

    public function removeAlbumArtist(AlbumArtist $albumArtist): self
    {
        if ($this->albumArtists->removeElement($albumArtist)) {
            // set the owning side to null (unless already changed)
            if ($albumArtist->getArtist() === $this) {
                $albumArtist->setArtist(null);
            }
        }

        return $this;
    }
}
