<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrainingRepository")
 */
class Training
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
    private $naam;

    /**
     * @ORM\Column(type="text")
     */
    private $omschrijving;

    /**
     * @ORM\Column(type="time")
     */
    private $looptijd;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=true)
     */
    private $kosten;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\lesson", mappedBy="training", orphanRemoval=true)
     */
    private $lesson;

    public function __construct()
    {
        $this->lesson = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNaam(): ?string
    {
        return $this->naam;
    }

    public function setNaam(string $naam): self
    {
        $this->naam = $naam;

        return $this;
    }

    public function getOmschrijving(): ?string
    {
        return $this->omschrijving;
    }

    public function setOmschrijving(string $omschrijving): self
    {
        $this->omschrijving = $omschrijving;

        return $this;
    }

    public function getLooptijd(): ?\DateTimeInterface
    {
        return $this->looptijd;
    }

    public function setLooptijd(\DateTimeInterface $looptijd): self
    {
        $this->looptijd = $looptijd;

        return $this;
    }

    public function getKosten(): ?string
    {
        return $this->kosten;
    }

    public function setKosten(?string $kosten): self
    {
        $this->kosten = $kosten;

        return $this;
    }

    /**
     * @return Collection|lesson[]
     */
    public function getLesson(): Collection
    {
        return $this->lesson;
    }

    public function addLesson(lesson $lesson): self
    {
        if (!$this->lesson->contains($lesson)) {
            $this->lesson[] = $lesson;
            $lesson->setTraining($this);
        }

        return $this;
    }

    public function removeLesson(lesson $lesson): self
    {
        if ($this->lesson->contains($lesson)) {
            $this->lesson->removeElement($lesson);
            // set the owning side to null (unless already changed)
            if ($lesson->getTraining() === $this) {
                $lesson->setTraining(null);
            }
        }

        return $this;
    }
}
