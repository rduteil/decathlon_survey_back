<?php

namespace AppBundle\GraphQL\Mutation\User;

use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Security\Guard;
use AppBundle\GraphQL\Type\UserType;
use AppBundle\GraphQL\Type\UserInputType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class AddUserField extends AbstractContainerAwareField
{
    public function build(FieldConfig $config)
    {
        $config->addArguments([
            'input' => [
                'type' => new NonNullType(new UserInputType()),
            ],
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info){
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([UserRoleEnum::ROLE_ADMIN], $user);

        [
            'username'  => $username, 
            'password'  => $password,
            'email'     => $email,
            'serviceId' => $serviceId
        ] = $args['input'];
        $user = $this->container->get('resolver.user')->add($username, $password, $email, $serviceId);
        return UserType::toArray($user);
    }

    public function getType(){
        return new UserType();
    }

    public function getName(){
        return 'addUser';
    }

    public function getDescription(){
        return 'Create a new user';
    }
}