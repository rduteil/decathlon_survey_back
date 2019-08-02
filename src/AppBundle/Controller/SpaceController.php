<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SpaceController extends Controller {
    /**
     * Matches /space
     * 
     * @Route("/space", name="spacepage")
     */
    public function space(Request $request){
        return new Response("Espace disque : ".$this->formatBytes(disk_total_space('/'))." dont ".$this->formatBytes(disk_free_space('/'))." libres");
    }

    function formatBytes($size){
        $base = log($size, 1024);
        $suffixes = array('', 'Ko', 'Mo', 'Go', 'To');   
        return round(pow(1024, $base - floor($base)), 2) .' '. $suffixes[floor($base)];
    }
}