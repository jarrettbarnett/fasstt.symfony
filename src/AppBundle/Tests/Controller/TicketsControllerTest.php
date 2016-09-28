<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TicketsControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/tickets');
    }

    public function testView()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/ticket/{id}');
    }

}
