<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\DiaporamaRepository")
 */
class Diaporama
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
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $resume;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date_debut_affichage;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_fin_affichage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelle_bouton;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url_bouton;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $case_nouvel_onglet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\categorie", inversedBy="diaporamas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_categorie;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getDateDebutAffichage(): ?\DateTimeInterface
    {
        return $this->date_debut_affichage;
    }

    public function setDateDebutAffichage(\DateTimeInterface $date_debut_affichage): self
    {
        $this->date_debut_affichage = $date_debut_affichage;

        return $this;
    }

    public function getDateFinAffichage(): ?\DateTimeInterface
    {
        return $this->date_fin_affichage;
    }

    public function setDateFinAffichage(?\DateTimeInterface $date_fin_affichage): self
    {
        $this->date_fin_affichage = $date_fin_affichage;

        return $this;
    }

    public function getLibelleBouton(): ?string
    {
        return $this->libelle_bouton;
    }

    public function setLibelleBouton(?string $libelle_bouton): self
    {
        $this->libelle_bouton = $libelle_bouton;

        return $this;
    }

    public function getUrlBouton(): ?string
    {
        return $this->url_bouton;
    }

    public function setUrlBouton(?string $url_bouton): self
    {
        $this->url_bouton = $url_bouton;

        return $this;
    }

    public function getCaseNouvelOnglet(): ?bool
    {
        return $this->case_nouvel_onglet;
    }

    public function setCaseNouvelOnglet(?bool $case_nouvel_onglet): self
    {
        $this->case_nouvel_onglet = $case_nouvel_onglet;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getIdCategorie(): ?categorie
    {
        return $this->id_categorie;
    }

    public function setIdCategorie(?categorie $id_categorie): self
    {
        $this->id_categorie = $id_categorie;

        return $this;
    }
}
