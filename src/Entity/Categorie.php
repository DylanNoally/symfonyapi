<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
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
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Diaporama", mappedBy="id_categorie")
     */
    private $diaporamas;

    public function __construct()
    {
        $this->diaporamas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Diaporama[]
     */
    public function getDiaporamas(): Collection
    {
        return $this->diaporamas;
    }

    public function addDiaporama(Diaporama $diaporama): self
    {
        if (!$this->diaporamas->contains($diaporama)) {
            $this->diaporamas[] = $diaporama;
            $diaporama->setIdCategorie($this);
        }

        return $this;
    }

    public function removeDiaporama(Diaporama $diaporama): self
    {
        if ($this->diaporamas->contains($diaporama)) {
            $this->diaporamas->removeElement($diaporama);
            // set the owning side to null (unless already changed)
            if ($diaporama->getIdCategorie() === $this) {
                $diaporama->setIdCategorie(null);
            }
        }

        return $this;
    }
}
