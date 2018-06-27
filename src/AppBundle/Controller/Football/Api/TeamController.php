<?php

namespace AppBundle\Controller\Football\Api;

use AppBundle\Entity\Football\Team;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class TeamController extends Controller
{
    /**
     * Lists all team entities.
     *
     * @Route("api/football/team", name="api_football_team_index")
     * @Method({"GET", "POST"})
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $teams = $em->getRepository('AppBundle:Football\Team');

        $responsePayLoad = array(
            'data' => array(
                'teams' => $teams->collections() 
            ) 
        );
        return $this->json($responsePayLoad);
    }

    /**
     * Creates a new team entity.
     *
     * @Route("/api/football/team/add", name="api_football_team_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $league = $em->getRepository('AppBundle:Football\League')->find($request->get('league_id'));
        $team = new Team();
        $team->setName($request->get('name'));
        $team->setStrip($request->get('strip'));
        $team->setLeagueId($league);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($team);
        $em->flush();

        $responsePayLoad = array(
            'id' => $team->getId(),
            'name' => $team->getName(),
            'strip' => $team->getStrip(),
            'league_id' => $league->getId()
        );
        return $this->json($responsePayLoad);
    }

    /**
     * Finds and displays a team entity.
     *
     * @Route("/api/football/team/{id}", name="api_football_team_show")
     * @Method("GET")
     */
    public function showAction(Team $team)
    {
        $em = $this->getDoctrine()->getManager();
        $teams = $em->getRepository('AppBundle:Football\Team');
        $responsePayLoad = array(
            'data' => array(
                'team' => $team->getArrayCopy($team),
                'league' => $teams->getAssociatedLeague($team->getId())
            ) 
        ); 
        return $this->json($responsePayLoad);
    }


    /**
     * Displays a form to edit an existing team entity.
     *
     * @Route("/api/football/team/{id}/edit", name="api_football_team_edit")
     * @Method({"POST"})
     */
    public function editAction(Request $request, Team $team)
    {
        $em = $this->getDoctrine()->getManager();
        $leagues = $em->getRepository('AppBundle:Football\League')->find($request->get('league_id'));

        $team->setName($request->get('name'));
        $team->setStrip($request->get('strip'));
        $team->setLeagueId($leagues);

        $em = $this->getDoctrine()->getManager();
        $em->persist($team);
        $em->flush();

        $responsePayLoad = array(
            'id' => $team->getId(),
            'name' => $team->getName(),
            'strip' => $team->getStrip(),
            'league_id' => $leagues->getId()
        );
        return $this->json($responsePayLoad);
    }

     /**
     * Deletes a league entity.
     *
     * @Route("/api/football/team/delete/{id}", name="api_football_team_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Team $team)
    {
        try{
            $em = $this->getDoctrine()->getManager();
            $em->remove($team);
            $em->flush();

            $response = array(
                'status' => 1 ,
                'message'=>'Team deleted successfully!!!');
        }catch(Exception $e){
            $response = array(
                'status' => 0 ,
                'message'=>$e->getMessage());
        }
        
        $responsePayLoad = array('data'=>$response);
        return $this->json($responsePayLoad);
    }

}
