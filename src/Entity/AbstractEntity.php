<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Attribute\Groups;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass]
#[ORM\HasLifecycleCallbacks]
abstract class AbstractEntity
{
    public const  RECORD_STATE_DEFAULT = 0;
    public const  RECORD_STATE_DELETED = 1;
    public const  RECORD_STATE_RESTORED = 2;
    public const  RECORD_STATE_SOFT_DELETED = 3;

    #[ORM\Column(type: Types::GUID)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator('doctrine.uuid_generator')]
    #[Groups(['read'])]

    protected ?string $id = null;

    #[ORM\Column]
    private ?string $userType = 'user';

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getUserType(): ?string
    {
        return $this->userType;
    }

    public function setUserType(?string $userType): void
    {
        $this->userType = $userType;
    }

}

