<?php

namespace App\Entity;

use App\Repository\IncidenteRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IncidenteRepository::class)]
class Incidente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $tipo = null;

    #[ORM\Column(length: 255)]
    private ?string $descripcion = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaincidente = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fechasuspencion = null;

    #[ORM\ManyToOne(inversedBy: 'incidente')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Usuario $usuario = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getFechaincidente(): ?\DateTimeInterface
    {
        return $this->fechaincidente;
    }

    public function setFechaincidente(\DateTimeInterface $fechaincidente): static
    {
        $this->fechaincidente = $fechaincidente;

        return $this;
    }

    public function getFechasuspencion(): ?\DateTimeInterface
    {
        return $this->fechasuspencion;
    }

    public function setFechasuspencion(?\DateTimeInterface $fechasuspencion): static
    {
        $this->fechasuspencion = $fechasuspencion;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): static
    {
        $this->usuario = $usuario;

        return $this;
    }
}
