<?php

use App\Models\Command;
use App\Repositories\CommandRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommandRepositoryTest extends TestCase
{
    use MakeCommandTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var CommandRepository
     */
    protected $commandRepo;

    public function setUp()
    {
        parent::setUp();
        $this->commandRepo = App::make(CommandRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateCommand()
    {
        $command = $this->fakeCommandData();
        $createdCommand = $this->commandRepo->create($command);
        $createdCommand = $createdCommand->toArray();
        $this->assertArrayHasKey('id', $createdCommand);
        $this->assertNotNull($createdCommand['id'], 'Created Command must have id specified');
        $this->assertNotNull(Command::find($createdCommand['id']), 'Command with given id must be in DB');
        $this->assertModelData($command, $createdCommand);
    }

    /**
     * @test read
     */
    public function testReadCommand()
    {
        $command = $this->makeCommand();
        $dbCommand = $this->commandRepo->find($command->id);
        $dbCommand = $dbCommand->toArray();
        $this->assertModelData($command->toArray(), $dbCommand);
    }

    /**
     * @test update
     */
    public function testUpdateCommand()
    {
        $command = $this->makeCommand();
        $fakeCommand = $this->fakeCommandData();
        $updatedCommand = $this->commandRepo->update($fakeCommand, $command->id);
        $this->assertModelData($fakeCommand, $updatedCommand->toArray());
        $dbCommand = $this->commandRepo->find($command->id);
        $this->assertModelData($fakeCommand, $dbCommand->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteCommand()
    {
        $command = $this->makeCommand();
        $resp = $this->commandRepo->delete($command->id);
        $this->assertTrue($resp);
        $this->assertNull(Command::find($command->id), 'Command should not exist in DB');
    }
}
