<?php

namespace App\Mapper;

use Doctrine\Common\Collections\Collection;

class UserMapper
{
    public static function mapArrayCollectionRolesToArrayValues(Collection $arrayCollectionRoles): array
    {
        $arrayRoles = $arrayCollectionRoles->map(function($role) {
            return $role->getValue();
        });

        return $arrayRoles->toArray();
    }
}