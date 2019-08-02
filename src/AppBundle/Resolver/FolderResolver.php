<?php

namespace AppBundle\Resolver;

use AppBundle\Entity\Folder;
use AppBundle\Entity\Service;
use Doctrine\Common\Collections\ArrayCollection;

class FolderResolver extends AbstractResolver {

    public function add(string $name, int $serviceId, int $folderId){
        $lastUpdate = date("d-m-Y H:i:s");
        $folder = new Folder($name, false, $lastUpdate);

        $service = $this->container->get('resolver.service')->findService($serviceId);
        $parentFolder = $this->findFolder($folderId);

        $parentFolder->addFolder($folder);
        $service->addFolder($folder);

        $this->persist($folder);
        return $folder;
    }

    public function addRoot(string $name){
        $lastUpdate = date("d-m-Y H:i:s");
        $folder = new Folder($name, true, $lastUpdate);
        $this->persist($folder);
        return $folder;        
    }

    public function update(Folder $folder, string $name, int $folderId){
        $folder->setLastUpdate(date("d-m-Y H:i:s"));
        $folder->setName($name);
        $folder->getFolder()->removeFolder($folder);
        $parentFolder = $this->findFolder($folderId);
        $parentFolder->addFolder($folder);
        $this->flush();
        return $folder;
    }

    public function delete(Folder $folder) {
        $folder->getFolder()->removeFolder($folder);
        $id = $folder->getId();
        $this->remove($folder);
        return $id;
    }

    public function findFolder(int $id){
        return $this->findOneBy('Folder', ['id' => $id]);
    }

    public function findFolderBy(array $arr){
        return $this->findOneBy('Folder', $arr);
    }

    public function findFolders(){
        return $this->findAll('Folder');
    }

}