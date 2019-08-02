<?php

namespace AppBundle\GraphQL\Query\Service;

use AppBundle\Entity\Enums\UserRoleEnum;
use AppBundle\GraphQL\Security\Guard;
use AppBundle\Entity\Service;
use AppBundle\GraphQL\Type\ServiceType;
use Youshido\GraphQL\Config\Field\FieldConfig;
use Youshido\GraphQL\Execution\ResolveInfo;
use Youshido\GraphQL\Type\ListType\ListType;
use Youshido\GraphQLBundle\Field\AbstractContainerAwareField;

class ServicesField extends AbstractContainerAwareField {

    public function resolve($value, array $args, ResolveInfo $info){
        $user = $this->container->get('resolver.user')->findTokenUser();
        Guard::allowRoles([UserRoleEnum::ROLE_USER, UserRoleEnum::ROLE_ADMIN], $user);
        
        $services = $this->container->get('resolver.service')->findServices();
        return array_map(function(Service $service) { return ServiceType::toArray($service); }, $services);
    }

    public function getType(){
        return new ListType(new ServiceType());
    }

    public function getName(){
        return 'services';
    }

    public function getDescription(){
        return 'Return all Services';
    }

}