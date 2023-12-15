<?php

namespace App\Service;

use App\DTO\CreateRoleDTO;
use App\Entity\Role;
use App\Repository\RoleRepository;

class RoleService {

    public function __construct(private RoleRepository $roleRepository)
    {

    }

    public function createRole(CreateRoleDTO $dto): Role
    {
        $role = new Role();
        $role->setValue($dto->value);
        $role->setDescription($dto->description);

        return $this->roleRepository->create($role);
    }

    public function getRoleByValue(string $value) 
    {
        return $this->roleRepository->findOneBy(["value" => $value]);
    }

}