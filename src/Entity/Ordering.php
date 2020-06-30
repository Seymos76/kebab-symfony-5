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
    protected const STATUS_PAYMENT_WAITING = "waiting";
    protected const STATUS_PAYMENT_AGAIN = "waiting again";
    protected const STATUS_PAYMENT_SUCCESS = "payed";
    protected const STATUS_PAYMENT_FAILURE = "failure";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"cart"})
     */
    protected $number;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="float")
     * @Groups({"cart"})
     */
    private $amount;

    /**
     * @ORM\Column(type="float")
     * @Groups({"cart"})
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
     * @Groups({"cart"})
     */
    private $customer;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fails;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=CartItem::class, mappedBy="ordering", orphanRemoval=true)
     */
    private $cartItems;

    public function __construct()
    {
        $this->number = uniqid();
        $this->createdAt = new \DateTime('now');
        $this->invoices = new ArrayCollection();
        $this->amount = 0.0;
        $this->tva = 0.0;
        $this->ttc = 0.0;
        $this->status = self::STATUS_PAYMENT_WAITING;
        $this->cartItems = new ArrayCollection();
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

    public function getFails(): ?int
    {
        return $this->fails;
    }

    public function setFails(?int $fails): self
    {
        $this->fails = $fails;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|CartItem[]
     */
    public function getProducts(): Collection
    {
        return $this->cartItems;
    }

    public function addProduct(CartItem $cartItem): self
    {
        if (!$this->cartItems->contains($cartItem)) {
            $this->cartItems[] = $cartItem;
            $cartItem->setOrdering($this);
        }

        return $this;
    }

    public function removeProduct(CartItem $cartItem): self
    {
        if ($this->cartItems->contains($cartItem)) {
            $this->cartItems->removeElement($cartItem);
            // set the owning side to null (unless already changed)
            if ($cartItem->getOrdering() === $this) {
                $cartItem->setOrdering(null);
            }
        }

        return $this;
    }

    public function emptyCart(): void
    {
        $this->cartItems->clear();
    }

    public function countProducts(): int
    {
        $count = 0;
        /**
         * @var int $key
         * @var CartItem $item
         */
        foreach ($this->cartItems as $key => $item) {
            $count += $item->getQuantity();
        }
        return $count;
    }
}
