<?php

namespace AppBundle\GraphQL\Mutation\Service;

use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Security\Guard;
use AppBundle\GraphQL\Type\ServiceType;
use AppBundle\GraphQL\Type\ServiceInputType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class UpdateServiceField extends AbstractContainerAwareField {

    public function build(FieldConfig $config) {
        $config->addArguments([
            'id' => [
                'type' => new NonNullType(new IdType()),
            ],
            'input' => [
                'type' => new NonNullType(new ServiceInputType()),
            ],
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info) {
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([UserRoleEnum::ROLE_ADMIN], $user);
        
        [
            'name'  => $name,
        ] = $args['input'];

        $service = $this->container->get('resolver.service')->findService($args['id']);
        $service = $this->container->get('resolver.service')->update($service, $name);
        return ServiceType::toArray($service); 
    }

    public function getType() {
        return new ServiceType();
    }

    public function getName() {
        return 'updateService';
    }

    public function getDescription() {
        return 'Update a Service';
    }

}