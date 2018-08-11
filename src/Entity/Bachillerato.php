<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BachilleratoRepository")
 */
class Bachillerato
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $titulo;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $institucion;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha_titulo;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\EmpleadoA", inversedBy="bachillerato")
     * @ORM\JoinColumn(nullable=false)
     */
    private $empleado_a;

    public function getId()
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getInstitucion(): ?string
    {
        return $this->institucion;
    }

    public function setInstitucion(string $institucion): self
    {
        $this->institucion = $institucion;

        return $this;
    }

    public function getFechaTitulo(): ?\DateTimeInterface
    {
        return $this->fecha_titulo;
    }

    public function setFechaTitulo(\DateTimeInterface $fecha_titulo): self
    {
        $this->fecha_titulo = $fecha_titulo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmpleadoA()
    {
        return $this->empleado_a;
    }

    /**
     * @param mixed $empleado_a
     */
    public function setEmpleadoA($empleado_a): void
    {
        $this->empleado_a = $empleado_a;
    }


}
