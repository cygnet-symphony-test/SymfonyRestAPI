<?php

namespace Tests\AppBundle\Controller;


class DefaultControllerTest extends BaseController
{

	public function testIndex()
	{
		$client = static::createClient();

		$crawler = $client->request('GET', '/');

		$this->assertEquals(200, $client->getResponse()->getStatusCode());
		$this->assertContains('Welcome to REST-API', $crawler->filter('#container h1')->text());
	}
 }
