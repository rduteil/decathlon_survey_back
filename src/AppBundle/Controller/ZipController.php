<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Debug\Exception\ContextErrorException;
use ZipArchive;

class ZipController extends Controller {
    /**
     * Matches /zip
     * 
     * @Route("/zip", name="zippage")
     */
    public function zip(Request $request){
        $surveyId = $request->request->get('surveyId');
        $hangout = $request->request->get('hangout');
        try {
            $files = scandir(dirname(dirname(dirname(dirname(__FILE__)))).'/saved_files/'.$surveyId.'/'.$hangout);
            $zip_name = dirname(dirname(dirname(dirname(__FILE__)))).'/saved_files/'.$surveyId.'/'.$hangout.'/'.$surveyId.'.zip';
            $zip = new ZipArchive;
            $zip->open($zip_name, ZIPARCHIVE::CREATE);
            foreach($files as $file){
                if(
                    file_exists(dirname(dirname(dirname(dirname(__FILE__)))).'/saved_files/'.$surveyId.'/'.$hangout.'/'.$file) &&
                    is_file(dirname(dirname(dirname(dirname(__FILE__)))).'/saved_files/'.$surveyId.'/'.$hangout.'/'.$file) &&
                    pathinfo(dirname(dirname(dirname(dirname(__FILE__)))).'/saved_files/'.$surveyId.'/'.$hangout.'/'.$file, PATHINFO_EXTENSION) !== 'zip'
                ){
                    $zip->addFile(dirname(dirname(dirname(dirname(__FILE__)))).'/saved_files/'.$surveyId.'/'.$hangout.'/'.$file, $file);
                }
            }
            $zip->close();
            $response = new Response(file_get_contents($zip_name));
            $response->headers->set('Content-Type', 'application/zip');
            $response->headers->set('Content-Disposition', 'attachment;filename="'.$zip_name.'"');
            $response->headers->set('Content-length', filesize($zip_name));
            return $response;
        }
        catch(ContextErrorException $e){
            return new Response('000');
        }
    }
}