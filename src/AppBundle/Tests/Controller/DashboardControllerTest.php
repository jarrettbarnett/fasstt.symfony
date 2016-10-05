<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DashboardControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/dashboard');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertNotEmpty($crawler->filter('h2')->text());
    }

}
