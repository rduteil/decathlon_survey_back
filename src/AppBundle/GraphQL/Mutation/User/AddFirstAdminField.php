<?php

namespace AppBundle\GraphQL\Mutation\User;

use AppBundle\GraphQL\Type\UserType;
use AppBundle\GraphQL\Type\UserInputType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\StringType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class AddFirstAdminField extends AbstractContainerAwareField
{
    public function build(FieldConfig $config)
    {
        $config->addArguments([
            'input' => [
                'type' => new NonNullType(new UserInputType()),
            ],
            'serviceName' => [
                'type' => new NonNullType(new StringType()),
            ]
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info){
        [
            'username'  => $username, 
            'password'  => $password,
            'email'     => $email,
            'serviceId' => $serviceId
        ] = $args['input'];

        $user = $this->container->get('resolver.user')->addFirstAdmin($username, $password, $args['serviceName']);
        return UserType::toArray($user);
    }

    public function getType(){
        return new UserType();
    }

    public function getName(){
        return 'addFirstAdmin';
    }

    public function getDescription(){
        return 'Create the first admin';
    }
}