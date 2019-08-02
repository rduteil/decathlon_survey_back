<?php

namespace AppBundle\GraphQL\Query\Service;

use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Security\Guard;
use AppBundle\GraphQL\Type\ServiceType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\NonNullType;
use Youshido\GraphQL\Type\Scalar\IdType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class ServiceField extends AbstractContainerAwareField {

    public function build(FieldConfig $config){
        $config->addArguments([
            'id' => [
                'type' => new NonNullType(new IdType()),
            ],
        ]);
    }

    public function resolve($value, array $args, ResolveInfo $info){
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([UserRoleEnum::ROLE_USER, UserRoleEnum::ROLE_ADMIN], $user);

        $service = $this->container->get('resolver.service')->findService($args['id']);
        return ServiceType::toArray($service);
    }

    public function getType(){
        return new ServiceType();
    }

    public function getName(){
        return 'service';
    }

    public function getDescription(){
        return 'Return a Service';
    }

}