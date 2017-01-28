<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BroadcastApiTest extends TestCase
{
    use MakeBroadcastTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateBroadcast()
    {
        $broadcast = $this->fakeBroadcastData();
        $this->json('POST', '/api/v1/broadcasts', $broadcast);

        $this->assertApiResponse($broadcast);
    }

    /**
     * @test
     */
    public function testReadBroadcast()
    {
        $broadcast = $this->makeBroadcast();
        $this->json('GET', '/api/v1/broadcasts/'.$broadcast->id);

        $this->assertApiResponse($broadcast->toArray());
    }

    /**
     * @test
     */
    public function testUpdateBroadcast()
    {
        $broadcast = $this->makeBroadcast();
        $editedBroadcast = $this->fakeBroadcastData();

        $this->json('PUT', '/api/v1/broadcasts/'.$broadcast->id, $editedBroadcast);

        $this->assertApiResponse($editedBroadcast);
    }

    /**
     * @test
     */
    public function testDeleteBroadcast()
    {
        $broadcast = $this->makeBroadcast();
        $this->json('DELETE', '/api/v1/broadcasts/'.$broadcast->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/broadcasts/'.$broadcast->id);

        $this->assertResponseStatus(404);
    }
}
