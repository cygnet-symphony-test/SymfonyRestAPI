<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class ApiController extends Controller
{
      /**
      * @Route("/ping", name="app_api_ping")
      * @Method({"GET", "POST"})
      */
      public function pingAction()
      {
         $dt = Carbon::now();
         return $this->json(array('time' => $dt ));
     }
 }
