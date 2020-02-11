<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\Email(message = "Veuillez insérer un email valide")     
     */
    private $email;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $genre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Ce champ ne peut être vide.")
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message = "Ce champ ne peut être vide.")
     */
    private $nom;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Assert\Type("\DateTime", message = "Date invalide(format requis : DD/MM/YYYY)")
     */     
    private $date_de_naissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\File(
     *      maxSize = "1024k",
     *      mimeTypes={ "image/jpeg", "image/png" },
     *      maxSizeMessage = "La photo ne peut dépasser les 1024 Ko soit 1,024 Mo !",
     *      mimeTypesMessage = "Format JPEG ou PNG uniquement"
     * )
     */
    private $photo;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Assert\Length(min = 10, minMessage = "Tel. 10 caractères minimun !")
     * @Assert\Length(max = 10, maxMessage = "Tel. 10 caractères maxnimun !")
     * @Assert\Regex(pattern="/^(\(0\))?[0-9]+$/", message="Format : 0301010101")
     */
    private $tel_mobile;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     * @Assert\Length(min = 10, minMessage = "Tel. 10 caractères minimun !")
     * @Assert\Length(max = 10, maxMessage = "Tel. 10 caractères maxnimun !")
     * @Assert\Regex(pattern="/^(\(0\))?[0-9]+$/", message="Format : 0301010101")
     */
    private $tel_fixe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $poste;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getGenre(): ?bool
    {
        return $this->genre;
    }

    public function setGenre(bool $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDateDeNaissance(): ?\DateTimeInterface
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(?\DateTimeInterface $date_de_naissance): self
    {
        $this->date_de_naissance = $date_de_naissance;

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

    public function getStatut(): ?bool
    {
        return $this->statut;
    }

    public function setStatut(bool $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getTelMobile(): ?string
    {
        return $this->tel_mobile;
    }

    public function setTelMobile(?string $tel_mobile): self
    {
        $this->tel_mobile = $tel_mobile;

        return $this;
    }

    public function getTelFixe(): ?string
    {
        return $this->tel_fixe;
    }

    public function setTelFixe(?string $tel_fixe): self
    {
        $this->tel_fixe = $tel_fixe;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(?string $poste): self
    {
        $this->poste = $poste;

        return $this;
    }
}
