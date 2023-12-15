<?php

namespace App\Mapper;

use Doctrine\Common\Collections\Collection;

class UserMapper
{
    public static function mapArrayCollectionRolesToArray(Collection $arrayCollectionRoles): array
    {
        $arrayRoles = $arrayCollectionRoles->map(function($role) {
            return [
                "id" => $role->getId(),
                "value" => $role->getValue(),
                "description" => $role->getDescription()
            ];
        });

        return $arrayRoles->toArray();
    }
}