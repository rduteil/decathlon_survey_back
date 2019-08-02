<?php

namespace AppBundle\Resolver;

use AppBundle\Entity\Service;
use AppBundle\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

class ServiceResolver extends AbstractResolver {

    public function add(string $name){
        $lastUpdate = date("d-m-Y H:i:s");
        $service = new Service($name, $lastUpdate);
        $folder = $this->container->get('resolver.folder')->addRoot($name);
        $service->addFolder($folder);
        $this->persist($service);
        return $service;
    }

    public function update(Service $service, string $name){
        $service->setLastUpdate(date("d-m-Y H:i:s"));
        foreach($service->getFolders() as $folder){
            if($folder->getIsRoot() === true){
                $folder->setName($name);
                $folder->setLastUpdate(date("d-m-Y H:i:s"));
            }
        }
        $service->setName($name);
        $this->flush();
        return $service;
    }

    public function delete(Service $service){
        $id = $service->getId();
        $this->remove($service);
        return $id;
    }

    public function findService(int $id){
        return $this->findOneBy('Service', ['id' => $id]);
    }

    public function findServiceBy(array $arr){
        return $this->findOneBy('Service', $arr);
    }

    public function findServices(){
        return $this->findAll('Service');
    }

}