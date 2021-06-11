<?php

namespace App\Entity;

use App\Repository\AttendanceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttendanceRepository::class)
 */
class Attendance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="attendances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $checkedAt;

    /**
     * @ORM\Column(type="string")
     */
    private $status;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPresent;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $absenceReason;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCheckedAt(): ?\DateTimeInterface
    {
        return $this->checkedAt;
    }

    public function setCheckedAt(?\DateTimeInterface $checkedAt): self
    {
        $this->checkedAt = $checkedAt;

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

    public function getIsPresent(): ?bool
    {
        return $this->isPresent;
    }

    public function setIsPresent(bool $isPresent): self
    {
        if ($isPresent) {
            $this->setStatus('Present');
        } else {
            $this->setStatus('Absence');
        }

        $this->setCheckedAt(
            new \DateTime()
        );
        $this->isPresent = $isPresent;

        return $this;
    }

    public function getAbsenceReason(): ?string
    {
        return $this->absenceReason;
    }

    public function setAbsenceReason(?string $absenceReason): self
    {
        $this->absenceReason = $absenceReason;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }


}
