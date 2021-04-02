<?php

namespace App\Entity;

use App\Repository\DocumentCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumentCategoryRepository::class)
 */
class DocumentCategory
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
     * @ORM\OneToMany(targetEntity=DocumentSubCategory::class, mappedBy="ParentCategory", orphanRemoval=true)
     */
    private $documentSubCategories;

    public function __construct()
    {
        $this->documentSubCategories = new ArrayCollection();
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

    /**
     * @return Collection|DocumentSubCategory[]
     */
    public function getDocumentSubCategories(): Collection
    {
        return $this->documentSubCategories;
    }

    public function addDocumentSubCategory(DocumentSubCategory $documentSubCategory): self
    {
        if (!$this->documentSubCategories->contains($documentSubCategory)) {
            $this->documentSubCategories[] = $documentSubCategory;
            $documentSubCategory->setParentCategory($this);
        }

        return $this;
    }

    public function removeDocumentSubCategory(DocumentSubCategory $documentSubCategory): self
    {
        if ($this->documentSubCategories->removeElement($documentSubCategory)) {
            // set the owning side to null (unless already changed)
            if ($documentSubCategory->getParentCategory() === $this) {
                $documentSubCategory->setParentCategory(null);
            }
        }

        return $this;
    }
}
