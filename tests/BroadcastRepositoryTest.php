<?php

use App\Models\Broadcast;
use App\Repositories\BroadcastRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BroadcastRepositoryTest extends TestCase
{
    use MakeBroadcastTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var BroadcastRepository
     */
    protected $broadcastRepo;

    public function setUp()
    {
        parent::setUp();
        $this->broadcastRepo = App::make(BroadcastRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateBroadcast()
    {
        $broadcast = $this->fakeBroadcastData();
        $createdBroadcast = $this->broadcastRepo->create($broadcast);
        $createdBroadcast = $createdBroadcast->toArray();
        $this->assertArrayHasKey('id', $createdBroadcast);
        $this->assertNotNull($createdBroadcast['id'], 'Created Broadcast must have id specified');
        $this->assertNotNull(Broadcast::find($createdBroadcast['id']), 'Broadcast with given id must be in DB');
        $this->assertModelData($broadcast, $createdBroadcast);
    }

    /**
     * @test read
     */
    public function testReadBroadcast()
    {
        $broadcast = $this->makeBroadcast();
        $dbBroadcast = $this->broadcastRepo->find($broadcast->id);
        $dbBroadcast = $dbBroadcast->toArray();
        $this->assertModelData($broadcast->toArray(), $dbBroadcast);
    }

    /**
     * @test update
     */
    public function testUpdateBroadcast()
    {
        $broadcast = $this->makeBroadcast();
        $fakeBroadcast = $this->fakeBroadcastData();
        $updatedBroadcast = $this->broadcastRepo->update($fakeBroadcast, $broadcast->id);
        $this->assertModelData($fakeBroadcast, $updatedBroadcast->toArray());
        $dbBroadcast = $this->broadcastRepo->find($broadcast->id);
        $this->assertModelData($fakeBroadcast, $dbBroadcast->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteBroadcast()
    {
        $broadcast = $this->makeBroadcast();
        $resp = $this->broadcastRepo->delete($broadcast->id);
        $this->assertTrue($resp);
        $this->assertNull(Broadcast::find($broadcast->id), 'Broadcast should not exist in DB');
    }
}
