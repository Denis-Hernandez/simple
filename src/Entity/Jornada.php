<?php

namespace App\Entity;

use App\Repository\JornadaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JornadaRepository::class)]
class Jornada
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\ManyToOne(inversedBy: 'jornada1')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipo $equipo1 = null;

    #[ORM\ManyToOne(inversedBy: 'jornada2')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipo $equipo2 = null;

    #[ORM\OneToMany(mappedBy: 'jornada', targetEntity: Gol::class, orphanRemoval: true)]
    private Collection $gol;

    public function __construct()
    {
        $this->gol = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getEquipo1(): ?Equipo
    {
        return $this->equipo1;
    }

    public function setEquipo1(?Equipo $equipo1): static
    {
        $this->equipo1 = $equipo1;

        return $this;
    }

    public function getEquipo2(): ?Equipo
    {
        return $this->equipo2;
    }

    public function setEquipo2(?Equipo $equipo2): static
    {
        $this->equipo2 = $equipo2;

        return $this;
    }

    /**
     * @return Collection<int, Gol>
     */
    public function getGol(): Collection
    {
        return $this->gol;
    }

    public function addGol(Gol $gol): static
    {
        if (!$this->gol->contains($gol)) {
            $this->gol->add($gol);
            $gol->setJornada($this);
        }

        return $this;
    }

    public function removeGol(Gol $gol): static
    {
        if ($this->gol->removeElement($gol)) {
            // set the owning side to null (unless already changed)
            if ($gol->getJornada() === $this) {
                $gol->setJornada(null);
            }
        }

        return $this;
    }
}
