<?php

namespace App\Entity;

use App\Repository\CircuitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=CircuitRepository::class)
 * @Vich\Uploadable
*/
class Circuit implements \Serializable
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
    private $libelle;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrDePlace;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Ville::class, inversedBy="circuits")
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     * @var string|null
     */
    private $imageName;
    /**
     *
     * @Vich\UploadableField(mapping="circuit", fileNameProperty="imageName")
     *
     * @var File|null
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="integer")
     */
    private $placeDisponible;



    public function __construct()
    {
        $this->ville = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getNbrDePlace(): ?int
    {
        return $this->nbrDePlace;
    }

    public function setNbrDePlace(int $nbrDePlace): self
    {
        $this->nbrDePlace = $nbrDePlace;
        $this->placeDisponible=$nbrDePlace;
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

    /**
     * @return Collection|ville[]
     */
    public function getVille(): Collection
    {
        return $this->ville;
    }

    public function addVille(ville $ville): self
    {
        if (!$this->ville->contains($ville)) {
            $this->ville[] = $ville;
        }

        return $this;
    }

    public function removeVille(ville $ville): self
    {
        $this->ville->removeElement($ville);

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
     $this->imageName = $imageName;
       return $this;
    }
    /**
     * @param File|UploadedFile|null $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->createdAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function getPlaceDisponible(): ?int
    {
        return $this->placeDisponible;
    }

    public function setPlaceDisponible(int $placeDisponible): self
    {
        $this->placeDisponible = $placeDisponible;

        return $this;
    }

    public function serialize() {

        return serialize(array(
            $this->id,
            $this->libelle,
            $this->nbrDePlace,
            $this->placeDisponible,
            $this->imageName,
            $this->description,
            $this->ville, 
        ));

    }

    public function unserialize($serialized) {

        list (
            $this->id,
            $this->libelle,
            $this->nbrDePlace,
            $this->placeDisponible,
            $this->imageName,
            $this->description,
            $this->ville,
            ) = unserialize($serialized);
    }
}
