<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AsistenciasRepository")
 */
class Asistencias
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codigobiometrico;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombres;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tipoempleado;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tiempoatraso;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tiempoantes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tiempoextra;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigobiometrico(): ?string
    {
        return $this->codigobiometrico;
    }

    public function setCodigobiometrico(string $codigobiometrico): self
    {
        $this->codigobiometrico = $codigobiometrico;

        return $this;
    }

    public function getNombres(): ?string
    {
        return $this->nombres;
    }

    public function setNombres(string $nombres): self
    {
        $this->nombres = $nombres;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getTipoempleado(): ?string
    {
        return $this->tipoempleado;
    }

    public function setTipoempleado(string $tipoempleado): self
    {
        $this->tipoempleado = $tipoempleado;

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

    public function getTiempoatraso(): ?string
    {
        return $this->tiempoatraso;
    }

    public function setTiempoatraso(string $tiempoatraso): self
    {
        $this->tiempoatraso = $tiempoatraso;

        return $this;
    }

    public function getTiempoantes(): ?string
    {
        return $this->tiempoantes;
    }

    public function setTiempoantes(string $tiempoantes): self
    {
        $this->tiempoantes = $tiempoantes;

        return $this;
    }

    public function getTiempoextra(): ?string
    {
        return $this->tiempoextra;
    }

    public function setTiempoextra(string $tiempoextra): self
    {
        $this->tiempoextra = $tiempoextra;

        return $this;
    }
}
