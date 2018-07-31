<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParroquiaRepository")
 */
class Parroquia
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
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Canton", inversedBy="parroquias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $canton;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EmpleadoA", mappedBy="parroquia")
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

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCanton(): ?Canton
    {
        return $this->canton;
    }

    public function setCanton(?Canton $canton): self
    {
        $this->canton = $canton;

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
            $empleadoA->setParroquia($this);
        }

        return $this;
    }

    public function removeEmpleadoA(EmpleadoA $empleadoA): self
    {
        if ($this->empleadoAs->contains($empleadoA)) {
            $this->empleadoAs->removeElement($empleadoA);
            // set the owning side to null (unless already changed)
            if ($empleadoA->getParroquia() === $this) {
                $empleadoA->setParroquia(null);
            }
        }

        return $this;
    }
}
