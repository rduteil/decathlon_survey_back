<?php

namespace AppBundle\Entity\Enums;

class UserRoleEnum {
    const ROLE_USER = 'ROLE_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';

    public static function toArray(){
        return [
            self::ROLE_USER,
            self::ROLE_ADMIN
        ];
    }
}