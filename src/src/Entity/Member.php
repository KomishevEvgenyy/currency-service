<?php

declare(strict_types=1);

namespace App\Entity;

use App\Infrastructure\Doctrine\Repository\MemberRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: MemberRepository::class)]
#[ORM\Table('member')]
class Member
{
    private UuidInterface $id;
    private ?string $name = null;
    private ?string $surName = null;
    private ?string $email = null;
    private ?DateTimeImmutable $createdTime;
    private ?DateTimeImmutable $updatedTime = null;
    private CurrencySubscription $currencySubscription;

    public function __construct()
    {
        $this->currencySubscription = new CurrencySubscription();
        $this->createdTime = new DateTimeImmutable('now');
    }

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @param UuidInterface $id
     */
    public function setId(UuidInterface $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getSurName(): ?string
    {
        return $this->surName;
    }

    /**
     * @param string|null $surName
     */
    public function setSurName(?string $surName): void
    {
        $this->surName = $surName;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getCreatedTime(): ?DateTimeImmutable
    {
        return $this->createdTime;
    }

    /**
     * @param DateTimeImmutable|null $createdTime
     */
    public function setCreatedTime(?DateTimeImmutable $createdTime): void
    {
        $this->createdTime = $createdTime;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getUpdatedTime(): ?DateTimeImmutable
    {
        return $this->updatedTime;
    }

    /**
     * @param DateTimeImmutable|null $updatedTime
     */
    public function setUpdatedTime(?DateTimeImmutable $updatedTime): void
    {
        $this->updatedTime = $updatedTime;
    }

    public function getFullName(): string
    {
        return $this->name . ' ' . $this->surName;
    }

    /**
     * @return CurrencySubscription|null
     */
    public function getCurrencySubscription(): ?CurrencySubscription
    {
        return $this->currencySubscription;
    }
}