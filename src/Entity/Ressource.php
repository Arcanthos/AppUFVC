<?php

namespace App\Entity;

use App\Repository\RessourceRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RessourceRepository::class)
 */
class Ressource
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
     * @ORM\ManyToOne(targetEntity=DocumentCategory::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @Assert\Positive
     * @ORM\Column(type="integer", nullable=false)
     */
    private $price;

    /**
     * @Assert\File(
     *     mimeTypes={"image/gif","image/jpeg","image/png","image/svg+xml"},
     *     mimeTypesMessage="formats autorisés : PNG,JPEG,GIF,SVG"
     * )
     */
    private $cover;

    /**
     * @ORM\Column(type="string")
     */
    private $cover_path;


    /**
     *  @Assert\File(
     *     mimeTypes={"application/pdf","application/x-pdf"},
     *     mimeTypesMessage="format autorisé : PDF"
     * )
     */
    private $file;

    /**
     * @ORM\Column(type="string")
     */
    private  $file_path;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $tags = [];

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $createAt;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }



    /**
     * @return mixed
     */
    public function getCover()
    {
        return $this->cover;
    }

    /**
     * @param File|null $coverFile
     */
    public function setCover(File $coverFile = null)
    {
        $this->cover = $coverFile;
    }

    /**
     * @return mixed
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param mixed $file
     */
    public function setFile( File $file): void
    {
        $this->file = $file;
    }

    /**
     * @return mixed
     */
    public function getCoverPath()
    {
        return $this->cover_path;
    }

    /**
     * @param mixed $cover_path
     */
    public function setCoverPath($cover_path): void
    {
        $this->cover_path = $cover_path;
    }

    /**
     * @return mixed
     */
    public function getFilePath()
    {
        return $this->file_path;
    }

    /**
     * @param mixed $file_path
     */
    public function setFilePath($file_path): void
    {
        $this->file_path = $file_path;
    }




    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     */
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * @param mixed $createAt
     */
    public function setCreateAt($createAt): void
    {
        $this->createAt = $createAt;
    }



}