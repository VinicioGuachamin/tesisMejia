<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HorarioRepository")
 */
class Horario
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
    private $lunes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $martes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $miercoles;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $jueves;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $viernes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sabado;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $domingo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EmpleadoA", mappedBy="horario")
     */
    private $empleado_a;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EmpleadoB", mappedBy="horario")
     */
    private $empleado_b;

    public function getId()
    {
        return $this->id;
    }

    public function getLunes(): ?string
    {
        return $this->lunes;
    }

    public function setLunes(string $lunes): self
    {
        $this->lunes = $lunes;

        return $this;
    }

    public function getMartes(): ?string
    {
        return $this->martes;
    }

    public function setMartes(string $martes): self
    {
        $this->martes = $martes;

        return $this;
    }

    public function getMiercoles(): ?string
    {
        return $this->miercoles;
    }

    public function setMiercoles(string $miercoles): self
    {
        $this->miercoles = $miercoles;

        return $this;
    }

    public function getJueves(): ?string
    {
        return $this->jueves;
    }

    public function setJueves(string $jueves): self
    {
        $this->jueves = $jueves;

        return $this;
    }

    public function getViernes(): ?string
    {
        return $this->viernes;
    }

    public function setViernes(string $viernes): self
    {
        $this->viernes = $viernes;

        return $this;
    }

    public function getSabado(): ?string
    {
        return $this->sabado;
    }

    public function setSabado(string $sabado): self
    {
        $this->sabado = $sabado;

        return $this;
    }

    public function getDomingo(): ?string
    {
        return $this->domingo;
    }

    public function setDomingo(string $domingo): self
    {
        $this->domingo = $domingo;

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

    /**
     * @return mixed
     */
    public function getEmpleadoB()
    {
        return $this->empleado_b;
    }

    /**
     * @param mixed $empleado_b
     */
    public function setEmpleadoB($empleado_b): void
    {
        $this->empleado_b = $empleado_b;
    }



}
