<?php

namespace Tests\AppBundle\Controller;

class TeamControllerTest extends BaseController
{

    public function testAddTeamDetails()
    {
        $client = $this->createAuthenticatedClient('admin','admin@@123');
        $payLoad = array(
            'name' => 'Team added from phpUnit', 
            'strip' => 'strip added From phpUnit', 
            'league_id' => 1, 
        );
        $client->request('POST', '/api/football/team/add',$payLoad);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    } 

    public function testListOfTeams()
    {
        $client = $this->createAuthenticatedClient('admin','admin@@123');
        $client->request('GET', '/api/football/team');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }   

    public function testShowTeamDetails()
    {
        $client = $this->createAuthenticatedClient('admin','admin@@123');
        $client->request('GET', '/api/football/team/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    } 

}
