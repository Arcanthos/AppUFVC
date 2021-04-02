<?php

namespace App\Entity;

use App\Repository\DocumentSubCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumentSubCategoryRepository::class)
 */
class DocumentSubCategory
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
     * @ORM\ManyToOne(targetEntity=DocumentCategory::class, inversedBy="documentSubCategories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ParentCategory;

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

    public function getParentCategory(): ?DocumentCategory
    {
        return $this->ParentCategory;
    }

    public function setParentCategory(?DocumentCategory $ParentCategory): self
    {
        $this->ParentCategory = $ParentCategory;

        return $this;
    }
}
