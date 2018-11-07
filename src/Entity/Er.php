<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ErRepository")
 */
class Er
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
    private $es;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEs(): ?string
    {
        return $this->es;
    }

    public function setEs(string $es): self
    {
        $this->es = $es;

        return $this;
    }
}
