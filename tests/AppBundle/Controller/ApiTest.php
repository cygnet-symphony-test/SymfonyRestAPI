<?php 
namespace Tests\AppBundle\Controller;


class ApiTest extends BaseController
{

	public function testPingTest()
	{
		$client = $this->createAuthenticatedClient('admin','admin@@123');

		$crawler = $client->request('POST', '/api/ping');

		$this->assertEquals(200, $client->getResponse()->getStatusCode());
	}
}