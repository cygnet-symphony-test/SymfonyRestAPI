<?php 
namespace Tests\AppBundle\Controller;


class GenerateTokenTest extends BaseController
{
    public function testGenerateToken()
    {
    	$client = $this->createAuthenticatedClient('admin','admin@@123');
    	
		$crawler = $client->request('POST', '/api/ping');

		$this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}