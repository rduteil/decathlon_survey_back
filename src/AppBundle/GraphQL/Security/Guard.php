<?php

namespace AppBundle\GraphQL\Security;

class Guard {
    public static function allowRoles(array $roles, $user){
        foreach ($user->getRoles() as $role){
            if (in_array($role, $roles)){
                return;
            }
        }
        throw new \Exception('Accès refusé', 403);
    }
}