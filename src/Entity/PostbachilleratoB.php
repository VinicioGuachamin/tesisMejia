<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PostbachilleratoBRepository")
 */
class PostbachilleratoB
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
     * @ORM\Column(type="date")
     * @Assert\Date()
     */
    private $fecha_titulo;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\EmpleadoB")
     * @ORM\JoinColumn(nullable=false)
     */
    private $empleado_b;

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

    /**
     * @return mixed
     */
    public function getFechaTitulo()
    {
        return $this->fecha_titulo;
    }

    /**
     * @param mixed $fecha_titulo
     */
    public function setFechaTitulo($fecha_titulo): void
    {
        $this->fecha_titulo = $fecha_titulo;
    }



    public function getEmpleadoB(): ?EmpleadoB
    {
        return $this->empleado_b;
    }

    public function setEmpleadoB(EmpleadoB $empleado_b): self
    {
        $this->empleado_b = $empleado_b;

        return $this;
    }
}
