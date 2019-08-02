<?php

namespace AppBundle\GraphQL\Query\User;

use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Security\Guard;
use AppBundle\Entity\User;
use AppBundle\GraphQL\Type\UserType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class UsersField extends AbstractContainerAwareField {

    public function build(FieldConfig $config) {

    }

    public function resolve($value, array $args, ResolveInfo $info) {
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([USerRoleEnum::ROLE_USER, UserRoleEnum::ROLE_ADMIN], $user);
        
        $users = $this->container->get('resolver.user')->findUsers();
        return array_map(function(User $user) { return UserType::toArray($user); }, $users);
    }

    public function getType() {
        return new ListType(new UserType());
    }

    public function getName() {
        return 'users';
    }

    public function getDescription() {
        return 'Return all Users';
    }

}