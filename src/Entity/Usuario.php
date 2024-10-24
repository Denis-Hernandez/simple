<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message:'El nombre es obligatorio')]
    private ?string $nombre = null;

    #[ORM\Column(length: 50)]
    #[Assert\NotBlank(message:'El apellido es obligatorio')]
    private ?string $apellido = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message:'La fecha es obligatoria')]
    private ?\DateTimeInterface $fecha_nac = null;

    #[ORM\ManyToOne(inversedBy: 'usuarios')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Equipo $equipo = null;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Gol::class, orphanRemoval: true)]
    private Collection $gol;

    #[ORM\OneToMany(mappedBy: 'usuario', targetEntity: Incidente::class, orphanRemoval: true)]
    private Collection $incidente;

    #[ORM\Column(length: 255)]
    private ?string $foto = null;

    public function __construct()
    {
        $this->gol = new ArrayCollection();
        $this->incidente = new ArrayCollection();
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

    public function getApellido(): ?string
    {
        return $this->apellido;
    }

    public function setApellido(string $apellido): static
    {
        $this->apellido = $apellido;

        return $this;
    }

    public function getFechaNac(): ?\DateTimeInterface
    {
        return $this->fecha_nac;
    }

    public function setFechaNac(\DateTimeInterface $fecha_nac): static
    {
        $this->fecha_nac = $fecha_nac;

        return $this;
    }

    public function getEquipo(): ?Equipo
    {
        return $this->equipo;
    }

    public function setEquipo(?Equipo $equipo): static
    {
        $this->equipo = $equipo;

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
            $gol->setUsuario($this);
        }

        return $this;
    }

    public function removeGol(Gol $gol): static
    {
        if ($this->gol->removeElement($gol)) {
            // set the owning side to null (unless already changed)
            if ($gol->getUsuario() === $this) {
                $gol->setUsuario(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Incidente>
     */
    public function getIncidente(): Collection
    {
        return $this->incidente;
    }

    public function addIncidente(Incidente $incidente): static
    {
        if (!$this->incidente->contains($incidente)) {
            $this->incidente->add($incidente);
            $incidente->setUsuario($this);
        }

        return $this;
    }

    public function removeIncidente(Incidente $incidente): static
    {
        if ($this->incidente->removeElement($incidente)) {
            // set the owning side to null (unless already changed)
            if ($incidente->getUsuario() === $this) {
                $incidente->setUsuario(null);
            }
        }

        return $this;
    }

    public function getFoto(): ?string
    {
        return $this->foto;
    }

    public function setFoto(string $foto): static
    {
        $this->foto = $foto;

        return $this;
    }
}
