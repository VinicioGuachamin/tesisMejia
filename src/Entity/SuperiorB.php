<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SuperiorBRepository")
 */
class SuperiorB
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
     * @ORM\Column(type="string", length=255)
     */
    private $registro_senescyt;

    /**
     * @ORM\Column(type="string", columnDefinition="ENUM('Tecnólogo', '3', '4')", length=255)
     * @Assert\Choice(choices = {"Tecnólogo","3", "4"})
     */
    private $nivel;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\EmpleadoB", inversedBy="superiors")
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

    public function getRegistroSenescyt(): ?string
    {
        return $this->registro_senescyt;
    }

    public function setRegistroSenescyt(string $registro_senescyt): self
    {
        $this->registro_senescyt = $registro_senescyt;

        return $this;
    }

    public function getNivel(): ?string
    {
        return $this->nivel;
    }

    public function setNivel(string $nivel): self
    {
        $this->nivel = $nivel;

        return $this;
    }

    public function getEmpleadoB(): ?EmpleadoB
    {
        return $this->empleado_b;
    }

    public function setEmpleadoB(?EmpleadoB $empleado_b): self
    {
        $this->empleado_b = $empleado_b;

        return $this;
    }
}
