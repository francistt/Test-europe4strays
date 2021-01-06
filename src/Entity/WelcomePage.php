<?php

namespace App\Entity;

use App\Repository\WelcomePageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=WelcomePageRepository::class)
 */
class WelcomePage
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
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $btnTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $btnUrl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $illustration;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $newsTitleOne;

    /**
     * @ORM\Column(type="text")
     */
    private $newsContentOne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $newsIllustrationOne;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $newsTitleTwo;

    /**
     * @ORM\Column(type="text")
     */
    private $newsContentTwo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $newsIllustrationTwo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getBtnTitle(): ?string
    {
        return $this->btnTitle;
    }

    public function setBtnTitle(string $btnTitle): self
    {
        $this->btnTitle = $btnTitle;

        return $this;
    }

    public function getBtnUrl(): ?string
    {
        return $this->btnUrl;
    }

    public function setBtnUrl(string $btnUrl): self
    {
        $this->btnUrl = $btnUrl;

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(string $illustration): self
    {
        $this->illustration = $illustration;

        return $this;
    }

    public function getNewsTitleOne(): ?string
    {
        return $this->newsTitleOne;
    }

    public function setNewsTitleOne(string $newsTitleOne): self
    {
        $this->newsTitleOne = $newsTitleOne;

        return $this;
    }

    public function getNewsContentOne(): ?string
    {
        return $this->newsContentOne;
    }

    public function setNewsContentOne(string $newsContentOne): self
    {
        $this->newsContentOne = $newsContentOne;

        return $this;
    }

    public function getNewsIllustrationOne(): ?string
    {
        return $this->newsIllustrationOne;
    }

    public function setNewsIllustrationOne(string $newsIllustrationOne): self
    {
        $this->newsIllustrationOne = $newsIllustrationOne;

        return $this;
    }

    public function getNewsTitleTwo(): ?string
    {
        return $this->newsTitleTwo;
    }

    public function setNewsTitleTwo(string $newsTitleTwo): self
    {
        $this->newsTitleTwo = $newsTitleTwo;

        return $this;
    }

    public function getNewsContentTwo(): ?string
    {
        return $this->newsContentTwo;
    }

    public function setNewsContentTwo(string $newsContentTwo): self
    {
        $this->newsContentTwo = $newsContentTwo;

        return $this;
    }

    public function getNewsIllustrationTwo(): ?string
    {
        return $this->newsIllustrationTwo;
    }

    public function setNewsIllustrationTwo(string $newsIllustrationTwo): self
    {
        $this->newsIllustrationTwo = $newsIllustrationTwo;

        return $this;
    }
}
