<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ImagesRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=ImagesRepository::class)
 * @Vich\Uploadable()
 */
class Images
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Vich\UploadableField(mapping="post_images", fileNameProperty="name")
     * @var File
     */
    private $nameFile;

    /**
     * @ORM\ManyToOne(targetEntity=Ad::class, inversedBy="images", cascade={"persist"})
     */
    private $annonce;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function __toString()
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get the value of nameFile
     *
     * @return  File|null
     */ 
    public function getNameFile(): ?File
    {
        return $this->nameFile;
    }

    /**
     * Set the value of nameFile
     *
     * @param File|null $nameFile
     * @return void
     */
    public function setNameFile(?File $nameFile = null)
    {
        $this->nameFile = $nameFile;

        if ($nameFile) {
            $this->updatedAt = new \DateTime();
        }
    }

    public function getAnnonce(): ?Ad
    {
        return $this->annonce;
    }

    public function setAnnonce(?Ad $annonce): self
    {
        $this->annonce = $annonce;

        return $this;
    }
}
