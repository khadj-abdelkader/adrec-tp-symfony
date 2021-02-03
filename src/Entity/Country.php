<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 * @UniqueEntity(fields={"name"}, message="country.form.unique_entity")
 */
class Country
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="country.form.regex_no_numbers"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nationality;

    /**
     * Par défaut Doctrine fait du LAZY => Il ne va chercher les entités en relation que lorsqu'il en a besoin
     * Toutefois cette méthode est plus coûteuse en requêtes (et donc en temps) car il va effecteur les requêtes sur le moment
     * C'est à dire, lorsque vous en avez besoin
     *
     * Il existe le fetch="EAGER" => qui lui intègrera vos entités en relation par défaut, et ce tout le temps
     * Que vous ayez besoin de les réutiliser ou non
     *
     * @ORM\OneToMany(targetEntity=Artist::class, mappedBy="country", fetch="LAZY")
     */
    private $artists;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
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

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     * @return string|null
     */
    public function __toString(): ?string
    {
        return $this->getName() . ' (' . $this->getNationality() . ')';
    }

    /**
     * @return Collection|Artist[]
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artist $artist): self
    {
        if (!$this->artists->contains($artist)) {
            $this->artists[] = $artist;
            $artist->setCountry($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): self
    {
        if ($this->artists->removeElement($artist)) {
            // set the owning side to null (unless already changed)
            if ($artist->getCountry() === $this) {
                $artist->setCountry(null);
            }
        }

        return $this;
    }
}
