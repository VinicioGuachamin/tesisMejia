<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CantonRepository")
 */
class Canton
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
     * @ORM\OneToMany(targetEntity="App\Entity\Parroquia", mappedBy="canton")
     */
    private $parroquias;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EmpleadoA", mappedBy="canton")
     */
    private $empleadoAs;

    public function __construct()
    {
        $this->parroquias = new ArrayCollection();
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

    /**
     * @return Collection|Parroquia[]
     */
    public function getParroquias(): Collection
    {
        return $this->parroquias;
    }

    public function addParroquia(Parroquia $parroquia): self
    {
        if (!$this->parroquias->contains($parroquia)) {
            $this->parroquias[] = $parroquia;
            $parroquia->setCanton($this);
        }

        return $this;
    }

    public function removeParroquia(Parroquia $parroquia): self
    {
        if ($this->parroquias->contains($parroquia)) {
            $this->parroquias->removeElement($parroquia);
            // set the owning side to null (unless already changed)
            if ($parroquia->getCanton() === $this) {
                $parroquia->setCanton(null);
            }
        }

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
            $empleadoA->setCanton($this);
        }

        return $this;
    }

    public function removeEmpleadoA(EmpleadoA $empleadoA): self
    {
        if ($this->empleadoAs->contains($empleadoA)) {
            $this->empleadoAs->removeElement($empleadoA);
            // set the owning side to null (unless already changed)
            if ($empleadoA->getCanton() === $this) {
                $empleadoA->setCanton(null);
            }
        }

        return $this;
    }
}
