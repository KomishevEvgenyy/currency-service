<?php

declare(strict_types=1);

namespace App\Entity;

use App\Infrastructure\Doctrine\Repository\CurrencySubscriptionRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity(repositoryClass: CurrencySubscriptionRepository::class)]
#[ORM\Table('currency_subscription')]
class CurrencySubscription
{
    private int $id;
    private bool $isActive;
    private UuidInterface $memberId;
    private ?DateTimeImmutable $createdTime;
    private ?DateTimeImmutable $updatedTime = null;
    private Member $member;

    public function __construct()
    {
        $this->member = new Member();
        $this->createdTime = new DateTimeImmutable('now');
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getIsActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
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

    /**
     * @return UuidInterface $member_id
     */
    /**
     * @return UuidInterface
     */
    public function getMemberId(): UuidInterface
    {
        return $this->memberId;
    }

    /**
     * @param UuidInterface $member_id
     */
    public function setMemberId(UuidInterface $memberId): void
    {
        $this->memberId = $memberId;
    }

    /**
     * @return Member
     */
    public function getMember(): Member
    {
        return $this->member;
    }
}
