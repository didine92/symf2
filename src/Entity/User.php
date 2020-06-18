<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 *  fields={"email"},
 *		errorPath="email",	
 *		message="cet email existe déjà"
 * )
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
     * @ORM\Column(type="string", length=255)
	 * @Assert\Email
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
	 * @Assert\Length(min="4", minMessage="Votre mot de passe doit contenir 4 caractères minimum")
     */
    private $password;
	
	/**
	* @Assert\EqualTo(propertyPath="Password", message="Votre confirmation du mot de passe doit correspondre au mot de passe")
	*/
    public $confirmPassword;

    /**
     * @ORM\Column(type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $creationUser;

    /**
     * @ORM\Column(type="integer")
     */
    private $updateUser;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;


    public function getId(): ?int
    {
        return $this->id;
    }



    public function getCreationDate(): ?\DateTimeInterface
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTimeInterface $creationDate): self
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getUpdateDate(): ?\DateTimeInterface
    {
        return $this->updateDate;
    }

    public function setUpdateDate(\DateTimeInterface $updateDate): self
    {
        $this->updateDate = $updateDate;

        return $this;
    }

    public function getCreationUser(): ?int
    {
        return $this->creationUser;
    }

    public function setCreationUser(int $creationUser): self
    {
        $this->creationUser = $creationUser;

        return $this;
    }

    public function getUpdateUser(): ?int
    {
        return $this->updateUser;
    }

    public function setUpdateUser(int $updateUser): self
    {
        $this->updateUser = $updateUser;

        return $this;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }
	
	public function eraseCredentials() {}
	
	public function getSalt(){}
	
	public function getRoles() {
         		return ['ROLE_USER'];
         	}

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }


}
