<?php

namespace AppBundle\GraphQL\Mutation\User;

use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Security\Guard;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class RemoveUserField extends AbstractContainerAwareField {

    public function build(FieldConfig $config) {
        $config->addArguments([
            'id' => [
                'type' => new NonNullType(new IdType()),
            ],
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info) {
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([UserRoleEnum::ROLE_ADMIN], $user);

        $user = $this->container->get('resolver.user')->findUser($args['id']);
        return $this->container->get('resolver.user')->delete($user);
    }

    public function getType() {
        return new IdType();
    }

    public function getName() {
        return 'removeUser';
    }

    public function getDescription() {
        return 'Delete an User';
    }
}