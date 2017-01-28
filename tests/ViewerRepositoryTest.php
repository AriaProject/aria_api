<?php

use App\Models\Viewer;
use App\Repositories\ViewerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewerRepositoryTest extends TestCase
{
    use MakeViewerTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ViewerRepository
     */
    protected $viewerRepo;

    public function setUp()
    {
        parent::setUp();
        $this->viewerRepo = App::make(ViewerRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateViewer()
    {
        $viewer = $this->fakeViewerData();
        $createdViewer = $this->viewerRepo->create($viewer);
        $createdViewer = $createdViewer->toArray();
        $this->assertArrayHasKey('id', $createdViewer);
        $this->assertNotNull($createdViewer['id'], 'Created Viewer must have id specified');
        $this->assertNotNull(Viewer::find($createdViewer['id']), 'Viewer with given id must be in DB');
        $this->assertModelData($viewer, $createdViewer);
    }

    /**
     * @test read
     */
    public function testReadViewer()
    {
        $viewer = $this->makeViewer();
        $dbViewer = $this->viewerRepo->find($viewer->id);
        $dbViewer = $dbViewer->toArray();
        $this->assertModelData($viewer->toArray(), $dbViewer);
    }

    /**
     * @test update
     */
    public function testUpdateViewer()
    {
        $viewer = $this->makeViewer();
        $fakeViewer = $this->fakeViewerData();
        $updatedViewer = $this->viewerRepo->update($fakeViewer, $viewer->id);
        $this->assertModelData($fakeViewer, $updatedViewer->toArray());
        $dbViewer = $this->viewerRepo->find($viewer->id);
        $this->assertModelData($fakeViewer, $dbViewer->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteViewer()
    {
        $viewer = $this->makeViewer();
        $resp = $this->viewerRepo->delete($viewer->id);
        $this->assertTrue($resp);
        $this->assertNull(Viewer::find($viewer->id), 'Viewer should not exist in DB');
    }
}
