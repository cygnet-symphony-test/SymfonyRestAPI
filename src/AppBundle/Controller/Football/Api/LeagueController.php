<?php

namespace AppBundle\Controller\Football\Api;

use AppBundle\Entity\Football\League;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class LeagueController extends Controller
{
    /**
     * Lists all league entities.
     *
     * @Route("api/football/league", name="api_football_league_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $leagues = $em->getRepository('AppBundle:Football\League');

        $responsePayLoad = array(
            'data' => array(
                'leagues' => $leagues->collections() 
            ) 
        );
        return $this->json($responsePayLoad);
    }

    /**
     * Creates a new league entity.
     *
     * @Route("/api/football/league/add", name="api_football_league_new")
     * @Method({"POST"})
     */
    public function newAction(Request $request)
    {
        $league = new League();
        $league->setName($request->get('name'));
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($league);
        $em->flush();

        $responsePayLoad = array(
            'id' => $league->getId(),
            'name' => $league->getName());
        return $this->json($responsePayLoad);
    }


    /**
     * Displays a form to edit an existing league entity.
     *
     * @Route("/api/football/league/{id}/edit", name="api_football_league_edit")
     * @Method({"POST"})
     */
    public function editAction(Request $request, League $league)
    {
        $em = $this->getDoctrine()->getManager();
        $league->setName($request->get('name'));
        $em->persist($league);
        $em->flush();

        $responsePayLoad = array(
            'id' => $league->getId(),
            'name' => $league->getName()
        );
        return $this->json($responsePayLoad);
    }


    /**
     * Finds and displays a league entity.
     *
     * @Route("api/football/league/{id}", name="api_football_league_show")
     * @Method("GET")
     */
    public function showAction(League $league)
    {
        $em = $this->getDoctrine()->getManager();
        $leagueObject = $em->getRepository('AppBundle:Football\League');

        $responsePayLoad = array(
            'data' => array(
                'league' => $league->getArrayCopy($league),
                'teams' => $leagueObject->getAssociatedTeams($league->getId()),
            ) 
        ); 
        return $this->json($responsePayLoad);
    }

    /**
     * Deletes a league entity.
     *
     * @Route("/api/football/league/delete/{id}", name="api_football_league_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, League $league)
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $em->remove($league);
            $em->flush();

            $response = array(
                'status' => 1 ,
                'message'=>'League deleted successfully!!!');
        }catch(Exception $e){
            $response = array(
                'status' => 0 ,
                'message'=>$e->getMessage());
        }
        
        $responsePayLoad = array('data'=>$response);
        return $this->json($responsePayLoad);
    }
}
