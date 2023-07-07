<?php

namespace App\Entity;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;

    #[ORM\Column]
    private int $parentId;

    #[ORM\Column(length: 80)]
    private string $name_uk;

    #[ORM\Column(length: 80)]
    private string $name_ru;

    #[ORM\Column(length: 80)]
    private string $alias;

    #[ORM\Column]
    private int $orderNumber;

    private array $children;

    private int $count;

    #[ORM\ManyToMany(targetEntity: Site::class, mappedBy: 'categories')]
    private $sites;

    public function __construct()
    {
        $this->sites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;

        return $this;
    }

    public function getName(string $locale): ?string
    {
        return $this->{'name_' . $locale};
    }

    public function getNameUk(): ?string
    {
        return $this->name_uk;
    }

    public function setNameUk(string $name_uk): self
    {
        $this->name_uk = $name_uk;

        return $this;
    }

    public function getNameRu(): ?string
    {
        return $this->name_ru;
    }

    public function setNameRu(string $name_ru): self
    {
        $this->name_ru = $name_ru;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getChildren(): ?array
    {
        return $this->children;
    }

    public function setChildren(array $children): self
    {
        $this->children = $children;

        return $this;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function setParentId(int $parentId): self
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * @return Collection<int, Site>
     */
    public function getSites(): Collection
    {
        return $this->sites;
    }

    public function addSite(Site $site): self
    {
        if (!$this->sites->contains($site)) {
            $this->sites->add($site);
            $site->addCategory($this);
        }

        return $this;
    }

    public function removeSite(Site $site): self
    {
        if ($this->sites->removeElement($site)) {
            $site->removeCategory($this);
        }

        return $this;
    }

    public function getOrderNumber(): ?int
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(int $orderNumber): self
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

}