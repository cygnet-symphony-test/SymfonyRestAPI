<?php

namespace Tests\AppBundle\Controller;

class LeagueControllerTest extends BaseController
{
    public function testAddLeague()
    {
        $client = $this->createAuthenticatedClient('admin','admin@@123');
        $payLoad = array(
            'name' => 'League added from phpUnit', 
        );
        $client->request('POST', '/api/football/league/add',$payLoad);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    } 

    public function testListOfLeagues()
    {
        $client = $this->createAuthenticatedClient('admin','admin@@123');
        $client->request('GET', '/api/football/league');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }   

    public function testShowLeagueDetails()
    {
        $client = $this->createAuthenticatedClient('admin','admin@@123');
        $client->request('GET', '/api/football/league/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    } 


}
