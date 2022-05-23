<?php

namespace App\Entity;

use App\Repository\HistoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoryRepository::class)]
class History
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Logins::class, inversedBy: 'histories')]
    private $login_id;

    #[ORM\Column(type: 'string', length: 255)]
    private $acts;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLoginId(): ?Logins
    {
        return $this->login_id;
    }

    public function setLoginId(?Logins $login_id): self
    {
        $this->login_id = $login_id;

        return $this;
    }

    public function getActs(): ?string
    {
        return $this->acts;
    }

    public function setActs(string $acts): self
    {
        $this->acts = $acts;

        return $this;
    }
}
