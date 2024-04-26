<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $year = null;

    #[ORM\Column]
    private ?int $artist = null;

    /**
     * @var Collection<int, Artist>
     */
    #[ORM\OneToMany(targetEntity: Artist::class, mappedBy: 'abulmies')]
    private Collection $artists;

    #[ORM\ManyToOne(inversedBy: 'albums')]
    private ?Track $trackes = null;

    /**
     * @var Collection<int, Artist>
     */
    #[ORM\OneToMany(targetEntity: Artist::class, mappedBy: 'album')]
    private Collection $astisties;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
        $this->astisties = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }

    public function getArtist(): ?int
    {
        return $this->artist;
    }

    public function setArtist(int $artist): static
    {
        $this->artist = $artist;

        return $this;
    }

    /**
     * @return Collection<int, Artist>
     */
    public function getArtists(): Collection
    {
        return $this->artists;
    }

    public function addArtist(Artist $artist): static
    {
        if (!$this->artists->contains($artist)) {
            $this->artists->add($artist);
            $artist->setAbulmies($this);
        }

        return $this;
    }

    public function removeArtist(Artist $artist): static
    {
        if ($this->artists->removeElement($artist)) {
            // set the owning side to null (unless already changed)
            if ($artist->getAbulmies() === $this) {
                $artist->setAbulmies(null);
            }
        }

        return $this;
    }

    public function getTrackes(): ?Track
    {
        return $this->trackes;
    }

    public function setTrackes(?Track $trackes): static
    {
        $this->trackes = $trackes;

        return $this;
    }

    /**
     * @return Collection<int, Artist>
     */
    public function getAstisties(): Collection
    {
        return $this->astisties;
    }

    public function addAstisty(Artist $astisty): static
    {
        if (!$this->astisties->contains($astisty)) {
            $this->astisties->add($astisty);
            $astisty->setAlbum($this);
        }

        return $this;
    }

    public function removeAstisty(Artist $astisty): static
    {
        if ($this->astisties->removeElement($astisty)) {
            // set the owning side to null (unless already changed)
            if ($astisty->getAlbum() === $this) {
                $astisty->setAlbum(null);
            }
        }

        return $this;
    }
}
