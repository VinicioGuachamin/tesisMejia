<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DetalleReporteRepository")
 */
class DetalleReporte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Reporte", inversedBy="detalleReporte")
     */
    private $reporte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $docente;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hr1;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hr2;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hr3;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hr4;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hr5;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hr6;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hr7;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hr8;

    /**
     * @ORM\Column(type="boolean")
     */
    private $atrasos;

    /**
     * @ORM\Column(type="boolean")
     */
    private $abondonaAula;

    /**
     * @ORM\Column(type="boolean")
     */
    private $cumplimientoTurno;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $observaciones;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReporte(): ?Reporte
    {
        return $this->reporte;
    }

    public function setReporte(Reporte $reporte): self
    {
        $this->reporte = $reporte;

        return $this;
    }

    public function getDocente(): ?string
    {
        return $this->docente;
    }

    public function setDocente(string $docente): self
    {
        $this->docente = $docente;

        return $this;
    }

    public function getHr1(): ?bool
    {
        return $this->hr1;
    }

    public function setHr1(bool $hr1): self
    {
        $this->hr1 = $hr1;

        return $this;
    }

    public function getHr2(): ?bool
    {
        return $this->hr2;
    }

    public function setHr2(bool $hr2): self
    {
        $this->hr2 = $hr2;

        return $this;
    }

    public function getHr3(): ?bool
    {
        return $this->hr3;
    }

    public function setHr3(bool $hr3): self
    {
        $this->hr3 = $hr3;

        return $this;
    }

    public function getHr4(): ?bool
    {
        return $this->hr4;
    }

    public function setHr4(bool $hr4): self
    {
        $this->hr4 = $hr4;

        return $this;
    }

    public function getHr5(): ?bool
    {
        return $this->hr5;
    }

    public function setHr5(bool $hr5): self
    {
        $this->hr5 = $hr5;

        return $this;
    }

    public function getHr6(): ?bool
    {
        return $this->hr6;
    }

    public function setHr6(bool $hr6): self
    {
        $this->hr6 = $hr6;

        return $this;
    }

    public function getHr7(): ?bool
    {
        return $this->hr7;
    }

    public function setHr7(bool $hr7): self
    {
        $this->hr7 = $hr7;

        return $this;
    }

    public function getHr8(): ?bool
    {
        return $this->hr8;
    }

    public function setHr8(bool $hr8): self
    {
        $this->hr8 = $hr8;

        return $this;
    }

    public function getAtrasos(): ?bool
    {
        return $this->atrasos;
    }

    public function setAtrasos(bool $atrasos): self
    {
        $this->atrasos = $atrasos;

        return $this;
    }

    public function getAbondonaAula(): ?bool
    {
        return $this->abondonaAula;
    }

    public function setAbondonaAula(bool $abondonaAula): self
    {
        $this->abondonaAula = $abondonaAula;

        return $this;
    }

    public function getCumplimientoTurno(): ?bool
    {
        return $this->cumplimientoTurno;
    }

    public function setCumplimientoTurno(bool $cumplimientoTurno): self
    {
        $this->cumplimientoTurno = $cumplimientoTurno;

        return $this;
    }

    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(string $observaciones): self
    {
        $this->observaciones = $observaciones;

        return $this;
    }
}
