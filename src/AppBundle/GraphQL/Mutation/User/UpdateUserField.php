<?php

namespace AppBundle\GraphQL\Mutation\User;

use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Security\Guard;
use AppBundle\GraphQL\Type\UserType;
use AppBundle\GraphQL\Type\UserInputType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class UpdateUserField extends AbstractContainerAwareField {

    public function build(FieldConfig $config) {
        $config->addArguments([
            'id' => [
                'type' => new NonNullType(new IdType()),
            ],
            'input' => [
                'type' => new NonNullType(new UserInputType()),
            ],
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info){
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([UserRoleEnum::ROLE_USER, UserRoleEnum::ROLE_ADMIN], $user);
        
        [
            'username'  => $username,
            'password'  => $password,
            'email'     => $email,
            'roles'     => $roles,
            'serviceId' => $serviceId,
        ] = $args['input'];
        
        //$user = $this->container->get('resolver.user')->update($args['id'], $username, $password, $email, $roles, $serviceId);
        $user = $this->container->get('resolver.user')->findUser($args['id']);
        $user = $this->container->get('resolver.user')->update($user, $username, $password, $email, $roles, $serviceId);
        return $user;
    }

    public function getType() {
        return new UserType();
    }

    public function getName() {
        return 'updateUser';
    }

    public function getDescription() {
        return 'Update an User';
    }

}