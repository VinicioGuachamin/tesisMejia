<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SueldoRepository")
 */
class Sueldo
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
    private $categoria;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $valor;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EmpleadoA", mappedBy="sueldo")
     */
    private $empleadoAs;

    public function __construct()
    {
        $this->empleadoAs = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(string $valor): self
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * @return Collection|EmpleadoA[]
     */
    public function getEmpleadoAs(): Collection
    {
        return $this->empleadoAs;
    }

    public function addEmpleadoA(EmpleadoA $empleadoA): self
    {
        if (!$this->empleadoAs->contains($empleadoA)) {
            $this->empleadoAs[] = $empleadoA;
            $empleadoA->setSueldo($this);
        }

        return $this;
    }

    public function removeEmpleadoA(EmpleadoA $empleadoA): self
    {
        if ($this->empleadoAs->contains($empleadoA)) {
            $this->empleadoAs->removeElement($empleadoA);
            // set the owning side to null (unless already changed)
            if ($empleadoA->getSueldo() === $this) {
                $empleadoA->setSueldo(null);
            }
        }

        return $this;
    }
}
