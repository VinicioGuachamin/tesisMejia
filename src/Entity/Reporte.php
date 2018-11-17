<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReporteRepository")
 */
class Reporte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\DetalleReporte", mappedBy="reporte")
     */
    private $detalleReporte;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $inspector;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jornada;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $grado;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $paralelos;

    public function __construct()
    {
        $this->detalleReporte = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|DetalleReporte[]
     */
    public function getDetalleReporte(): Collection
    {
        return $this->detalleReporte;
    }

    public function addDetalleReporte(DetalleReporte $detalleReporte): self
    {
        if (!$this->detalleReporte->contains($detalleReporte)) {
            $this->detalleReporte[] = $detalleReporte;
            $detalleReporte->setReporte($this);
        }

        return $this;
    }

    public function removeDetalleReporte(DetalleReporte $detalleReporte): self
    {
        if ($this->detalleReporte->contains($detalleReporte)) {
            $this->detalleReporte->removeElement($detalleReporte);
            // set the owning side to null (unless already changed)
            if ($detalleReporte->getReporte() === $this) {
                $detalleReporte->setReporte(null);
            }
        }

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getInspector(): ?string
    {
        return $this->inspector;
    }

    public function setInspector(string $inspector): self
    {
        $this->inspector = $inspector;

        return $this;
    }

    public function getJornada(): ?string
    {
        return $this->jornada;
    }

    public function setJornada(string $jornada): self
    {
        $this->jornada = $jornada;

        return $this;
    }

    public function getGrado(): ?string
    {
        return $this->grado;
    }

    public function setGrado(string $grado): self
    {
        $this->grado = $grado;

        return $this;
    }

    public function getParalelos(): ?string
    {
        return $this->paralelos;
    }

    public function setParalelos(string $paralelos): self
    {
        $this->paralelos = $paralelos;

        return $this;
    }
}
