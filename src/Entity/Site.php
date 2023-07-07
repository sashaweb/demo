<?php

namespace App\Entity;

use App\Enum\Status;
use App\Repository\SiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as AcmeAssert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use App\Repository\CategoryRepository;

#[ORM\Entity(repositoryClass: SiteRepository::class)]
#[UniqueEntity(fields: ['domain'], errorPath: 'domain',)]
class Site
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\NotNull]
    #[AcmeAssert\HasNotChildren]
    private int $categoryId;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'sites')]
    private Collection $categories;

    #[ORM\Column]
    private Status $status;

    #[ORM\Column(length: 80, nullable: true)]
    private ?string $confirmationCode;

    #[ORM\Column(length: 128)]
    private string $name;

    #[ORM\Column(length: 80, unique: true)]
    #[Assert\Hostname]
    private string $domain;

    #[ORM\Column(length: 80)]
    #[Assert\Email]
    private string $email;

    #[ORM\Column(length: 4096)]
    #[Assert\Length(min: 150, max: 4096)]
    private string $description;

    #[ORM\Column(length: 80)]
    private string $ip;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private \DateTime $createdAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private \DateTime $updatedAt;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConfirmationCode(): ?string
    {
        return $this->confirmationCode;
    }

    public function setConfirmationCode(?string $confirmationCode): self
    {
        $this->confirmationCode = $confirmationCode;

        return $this;
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

    public function getDomain(): ?string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): self
    {
        $this->domain = $domain;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getShortDescription(): ?string
    {
        if (mb_strlen($this->description) > 350) {
            return mb_substr($this->description, 0, 350) . ' ...';
        } else {
            return $this->description;
        }
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->categoryId;
    }

    public function setCategoryId(int $categoryId): self
    {
        $this->categoryId = $categoryId;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): self
    {
        $this->status = $status;

        return $this;
    }


}