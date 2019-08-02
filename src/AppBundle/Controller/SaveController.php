<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class SaveController extends Controller {
    /**
     * Matches /save
     * 
     * @Route("/save", name="savepage")
     */
    public function save(Request $request){
        $file = $request->request->get('file');        
        $filename = $request->request->get('filename');
        $surveyId = $request->request->get('surveyId');
        $hangout = $request->request->get('hangout');

        $oldmask = umask(0);
        if(!file_exists(dirname(dirname(dirname(dirname(__FILE__)))).'/saved_files/'.$surveyId)){
            mkdir(dirname(dirname(dirname(dirname(__FILE__)))).'/saved_files/'.$surveyId, 0777, true);
        }
        if(!file_exists(dirname(dirname(dirname(dirname(__FILE__)))).'/saved_files/'.$surveyId.'/'.$hangout)){
            mkdir(dirname(dirname(dirname(dirname(__FILE__)))).'/saved_files/'.$surveyId.'/'.$hangout, 0777, true);
        }

        $formerFilename = $filename;
        $validityLimit = strtotime("-1 minutes");
        $i = 0;
        while(
            file_exists(dirname(dirname(dirname(dirname(__FILE__)))).'/saved_files/'.$surveyId.'/'.$hangout.'/'.$filename) &&
            filemtime(dirname(dirname(dirname(dirname(__FILE__)))).'/saved_files/'.$surveyId.'/'.$hangout.'/'.$filename) < $validityLimit
        ){
            $i++;
            $filenameBase = pathinfo($formerFilename, PATHINFO_FILENAME);
            $filenameExtension = pathinfo($formerFilename, PATHINFO_EXTENSION);
            $filename = $filenameBase.'_'.$i.'.'.$filenameExtension;        
        }

        umask($oldmask);

        file_put_contents(
            dirname(dirname(dirname(dirname(__FILE__)))).'/saved_files/'.$surveyId.'/'.$hangout.'/'.$filename,
            base64_decode($file),
            FILE_APPEND
        );
        return new Response($filename);
    }
}