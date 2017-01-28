<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewerApiTest extends TestCase
{
    use MakeViewerTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateViewer()
    {
        $viewer = $this->fakeViewerData();
        $this->json('POST', '/api/v1/viewers', $viewer);

        $this->assertApiResponse($viewer);
    }

    /**
     * @test
     */
    public function testReadViewer()
    {
        $viewer = $this->makeViewer();
        $this->json('GET', '/api/v1/viewers/'.$viewer->id);

        $this->assertApiResponse($viewer->toArray());
    }

    /**
     * @test
     */
    public function testUpdateViewer()
    {
        $viewer = $this->makeViewer();
        $editedViewer = $this->fakeViewerData();

        $this->json('PUT', '/api/v1/viewers/'.$viewer->id, $editedViewer);

        $this->assertApiResponse($editedViewer);
    }

    /**
     * @test
     */
    public function testDeleteViewer()
    {
        $viewer = $this->makeViewer();
        $this->json('DELETE', '/api/v1/viewers/'.$viewer->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/viewers/'.$viewer->id);

        $this->assertResponseStatus(404);
    }
}
