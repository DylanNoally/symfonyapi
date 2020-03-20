<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\EntiteRepository")
 */
class Entite
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
    private $Resume;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $texte_long;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $date_de_publication;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo_additionnelle;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $etat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fichier_pdf;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $liens;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $complement_adresse;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $site_web;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email_general;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email_alertes;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url_facebook;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url_twitter;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url_instagram;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url_youtube;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url_linkedin;

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
        return $this->Resume;
    }

    public function setResume(?string $Resume): self
    {
        $this->Resume = $Resume;

        return $this;
    }

    public function getTexteLong(): ?string
    {
        return $this->texte_long;
    }

    public function setTexteLong(?string $texte_long): self
    {
        $this->texte_long = $texte_long;

        return $this;
    }

    public function getDateDePublication(): ?\DateTimeInterface
    {
        return $this->date_de_publication;
    }

    public function setDateDePublication(?\DateTimeInterface $date_de_publication): self
    {
        $this->date_de_publication = $date_de_publication;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPhotoAdditionnelle(): ?string
    {
        return $this->photo_additionnelle;
    }

    public function setPhotoAdditionnelle(?string $photo_additionnelle): self
    {
        $this->photo_additionnelle = $photo_additionnelle;

        return $this;
    }

    public function getEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(?bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getFichierPdf(): ?string
    {
        return $this->fichier_pdf;
    }

    public function setFichierPdf(?string $fichier_pdf): self
    {
        $this->fichier_pdf = $fichier_pdf;

        return $this;
    }

    public function getLiens(): ?string
    {
        return $this->liens;
    }

    public function setLiens(?string $liens): self
    {
        $this->liens = $liens;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getComplementAdresse(): ?string
    {
        return $this->complement_adresse;
    }

    public function setComplementAdresse(?string $complement_adresse): self
    {
        $this->complement_adresse = $complement_adresse;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(?int $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(?int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getFax(): ?int
    {
        return $this->fax;
    }

    public function setFax(?int $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getSiteWeb(): ?string
    {
        return $this->site_web;
    }

    public function setSiteWeb(?string $site_web): self
    {
        $this->site_web = $site_web;

        return $this;
    }

    public function getEmailGeneral(): ?string
    {
        return $this->email_general;
    }

    public function setEmailGeneral(?string $email_general): self
    {
        $this->email_general = $email_general;

        return $this;
    }

    public function getEmailAlertes(): ?string
    {
        return $this->email_alertes;
    }

    public function setEmailAlertes(?string $email_alertes): self
    {
        $this->email_alertes = $email_alertes;

        return $this;
    }

    public function getUrlFacebook(): ?string
    {
        return $this->url_facebook;
    }

    public function setUrlFacebook(?string $url_facebook): self
    {
        $this->url_facebook = $url_facebook;

        return $this;
    }

    public function getUrlTwitter(): ?string
    {
        return $this->url_twitter;
    }

    public function setUrlTwitter(?string $url_twitter): self
    {
        $this->url_twitter = $url_twitter;

        return $this;
    }

    public function getUrlInstagram(): ?string
    {
        return $this->url_instagram;
    }

    public function setUrlInstagram(?string $url_instagram): self
    {
        $this->url_instagram = $url_instagram;

        return $this;
    }

    public function getUrlYoutube(): ?string
    {
        return $this->url_youtube;
    }

    public function setUrlYoutube(?string $url_youtube): self
    {
        $this->url_youtube = $url_youtube;

        return $this;
    }

    public function getUrlLinkedin(): ?string
    {
        return $this->url_linkedin;
    }

    public function setUrlLinkedin(?string $url_linkedin): self
    {
        $this->url_linkedin = $url_linkedin;

        return $this;
    }
}
