<?php

namespace App\Entity;

use App\Repository\EquipoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EquipoRepository::class)]
class Equipo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\OneToMany(mappedBy: 'equipo', targetEntity: Usuario::class, orphanRemoval: true)]
    private Collection $usuarios;

    #[ORM\OneToMany(mappedBy: 'equipo1', targetEntity: Jornada::class, orphanRemoval: true)]
    private Collection $jornada1;

    #[ORM\OneToMany(mappedBy: 'equipo2', targetEntity: Jornada::class, orphanRemoval: true)]
    private Collection $jornada2;

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
        $this->jornada1 = new ArrayCollection();
        $this->jornada2 = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection<int, Usuario>
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    public function addUsuario(Usuario $usuario): static
    {
        if (!$this->usuarios->contains($usuario)) {
            $this->usuarios->add($usuario);
            $usuario->setEquipo($this);
        }

        return $this;
    }

    public function removeUsuario(Usuario $usuario): static
    {
        if ($this->usuarios->removeElement($usuario)) {
            // set the owning side to null (unless already changed)
            if ($usuario->getEquipo() === $this) {
                $usuario->setEquipo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Jornada>
     */
    public function getJornada1(): Collection
    {
        return $this->jornada1;
    }

    public function addJornada1(Jornada $jornada1): static
    {
        if (!$this->jornada1->contains($jornada1)) {
            $this->jornada1->add($jornada1);
            $jornada1->setEquipo($this);
        }

        return $this;
    }

    public function removeJornada1(Jornada $jornada1): static
    {
        if ($this->jornada1->removeElement($jornada1)) {
            // set the owning side to null (unless already changed)
            if ($jornada1->getEquipo() === $this) {
                $jornada1->setEquipo(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Jornada>
     */
    public function getJornada2(): Collection
    {
        return $this->jornada2;
    }

    public function addJornada2(Jornada $jornada2): static
    {
        if (!$this->jornada2->contains($jornada2)) {
            $this->jornada2->add($jornada2);
            $jornada2->setEquipo2($this);
        }

        return $this;
    }

    public function removeJornada2(Jornada $jornada2): static
    {
        if ($this->jornada2->removeElement($jornada2)) {
            // set the owning side to null (unless already changed)
            if ($jornada2->getEquipo2() === $this) {
                $jornada2->setEquipo2(null);
            }
        }

        return $this;
    }
}
