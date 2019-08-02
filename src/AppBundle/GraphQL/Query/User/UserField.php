<?php

namespace AppBundle\GraphQL\Query\User;

use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Security\Guard;
use AppBundle\GraphQL\Type\UserType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class UserField extends AbstractContainerAwareField {

    public function build(FieldConfig $config){
        $config->addArguments([
            'id' => [
                'type' => new NonNullType(new IdType()),
            ],
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info){
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([USerRoleEnum::ROLE_USER, UserRoleEnum::ROLE_ADMIN], $user);

        $user = $this->container->get('resolver.user')->findUser($args['id']);
        return UserType::toArray($user);
    }

    public function getType(){
        return new UserType();
    }

    public function getName(){
        return 'user';
    }

    public function getDescription(){
        return 'Return a User';
    }

}