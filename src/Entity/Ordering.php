<?php

namespace App\Entity;

use App\Repository\OrderingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Ecommerce\Ordering\OrderingInterface;

/**
 * @ORM\Entity(repositoryClass=OrderingRepository::class)
 */
class Ordering extends AbstractOrdering implements OrderingInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"public"})
     */
    protected $number;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="float")
     */
    private $amount;

    /**
     * @ORM\Column(type="float")
     */
    private $tva;

    /**
     * @ORM\Column(type="float")
     */
    private $ttc;

    /**
     * @ORM\OneToMany(targetEntity=Invoice::class, mappedBy="ordering")
     */
    private $invoices;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="orderings")
     * @ORM\JoinColumn(nullable=true)
     */
    private $customer;

    /**
     * @ORM\Column(type="array")
     */
    private $products;

    public function __construct()
    {
        $this->number = uniqid();
        $this->createdAt = new \DateTime('now');
        $this->invoices = new ArrayCollection();
        $this->products = new ArrayCollection();
        $this->amount = 0.0;
        $this->tva = 0.0;
        $this->ttc = 0.0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

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
     * @return Collection|Invoice[]
     */
    public function getInvoices(): Collection
    {
        return $this->invoices;
    }

    public function addInvoice(Invoice $invoice): self
    {
        if (!$this->invoices->contains($invoice)) {
            $this->invoices[] = $invoice;
            $invoice->setOrdering($this);
        }

        return $this;
    }

    public function removeInvoice(Invoice $invoice): self
    {
        if ($this->invoices->contains($invoice)) {
            $this->invoices->removeElement($invoice);
            // set the owning side to null (unless already changed)
            if ($invoice->getOrdering() === $this) {
                $invoice->setOrdering(null);
            }
        }

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function addProduct(array $product)
    {
        if(!$this->getProducts()->contains($product)) {
            $this->getProducts()->add($product);
        }
        return $this->products;
    }

    public function removeProduct(array $product)
    {
        if($this->getProducts()->contains($product)) {
            array_shift($product, $this->products);
        }
        return $this->products;
    }

    public function getProducts()
    {
        return $this->products;
    }

    public function setProductQuantity(int $product, int $qty)
    {}

    public function getProductQuantity()
    {}

    public function countProducts()
    {
        return $this->getProducts()->count();
    }

    public function emptyCart()
    {
        if($this->countProducts() > 0) {
            $this->products = new ArrayCollection();
        }
        return $this->products;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getTva(): ?float
    {
        return $this->tva;
    }

    public function setTva(float $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getTtc(): ?float
    {
        return $this->ttc;
    }

    public function setTtc(float $ttc): self
    {
        $this->ttc = $ttc;

        return $this;
    }
}
