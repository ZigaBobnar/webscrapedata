<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvtonetAdRepository")
 */
class AvtonetAd
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
    private $title;

    /**
     * @ORM\Column(type="integer")
     */
    private $avtonetId;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=4, nullable=true)
     */
    private $price;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $features = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coverImageName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $firstSeenOn;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedOn;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $changelog = [];

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

    public function getAvtonetId(): ?int
    {
        return $this->avtonetId;
    }

    public function setAvtonetId(int $avtonetId): self
    {
        $this->avtonetId = $avtonetId;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getFeatures(): ?array
    {
        return $this->features;
    }

    public function setFeatures(?array $features): self
    {
        $this->features = $features;

        return $this;
    }

    public function getCoverImageName(): ?string
    {
        return $this->coverImageName;
    }

    public function setCoverImageName(?string $coverImageName): self
    {
        $this->coverImageName = $coverImageName;

        return $this;
    }

    public function getFirstSeenOn(): ?\DateTimeInterface
    {
        return $this->firstSeenOn;
    }

    public function setFirstSeenOn(\DateTimeInterface $firstSeenOn): self
    {
        $this->firstSeenOn = $firstSeenOn;

        return $this;
    }

    public function getUpdatedOn(): ?\DateTimeInterface
    {
        return $this->updatedOn;
    }

    public function setUpdatedOn(?\DateTimeInterface $updatedOn): self
    {
        $this->updatedOn = $updatedOn;

        return $this;
    }

    public function getChangelog(): ?array
    {
        return $this->changelog;
    }

    public function setChangelog(?array $changelog): self
    {
        $this->changelog = $changelog;

        return $this;
    }

    public function toArrray() {
      return [
        'id' => $this->getId(),
        'title' => $this->getTitle(),
        'avtonetId' => $this->getAvtonetId(),
        'price' => $this->getPrice(),
        'features' => $this->getFeatures(),
        'coverImageName' => $this->getCoverImageName(),
        'firstSeenOn' => $this->getFirstSeenOn(),
        'updatedOn' => $this->getUpdatedOn(),
        'changelog' => $this->getChangelog()
      ];
    }
    
    public function fromArray($data) {
        $this->setTitle($data['title'] ?? '');
        $this->setAvtonetId($data['avtonetId'] ?? null);
        $this->setPrice($data['price'] ?? null);
        $this->setFeatures($data['features'] ?? []);
        $this->setCoverImageName($data['coverImageName'] ?? null);
        $this->setFirstSeenOn(isset($data['firstSeenOn']) ?
            \DateTime::createFromFormat('Y-m-d\TH:i:s+', $data['firstSeenOn']) :
            new \DateTime());
        $this->setUpdatedOn(isset($data['updatedOn']) ?
            \DateTime::createFromFormat('Y-m-d\TH:i:s+', $data['updatedOn']) :
            new \DateTime());
        $this->setChangelog($data['changelog'] ?? []);
    }
    
    public function isEqualTo(AvtonetAd $ad) {
        return $this->getAvtonetId() == $this->getAvtonetId() &&
            $this->getTitle() == $ad->getTitle() &&
            $this->getPrice() == $ad->getPrice() &&
            $this->getFeatures() == $ad->getFeatures() &&
            $this->getCoverImageName() == $ad->getCoverImageName();
    }
    
    public function addToChangelog($changes, \DateTime $datetime) {
    
    }
}
