<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CommandApiTest extends TestCase
{
    use MakeCommandTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateCommand()
    {
        $command = $this->fakeCommandData();
        $this->json('POST', '/api/v1/commands', $command);

        $this->assertApiResponse($command);
    }

    /**
     * @test
     */
    public function testReadCommand()
    {
        $command = $this->makeCommand();
        $this->json('GET', '/api/v1/commands/'.$command->id);

        $this->assertApiResponse($command->toArray());
    }

    /**
     * @test
     */
    public function testUpdateCommand()
    {
        $command = $this->makeCommand();
        $editedCommand = $this->fakeCommandData();

        $this->json('PUT', '/api/v1/commands/'.$command->id, $editedCommand);

        $this->assertApiResponse($editedCommand);
    }

    /**
     * @test
     */
    public function testDeleteCommand()
    {
        $command = $this->makeCommand();
        $this->json('DELETE', '/api/v1/commands/'.$command->iidd);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/commands/'.$command->id);

        $this->assertResponseStatus(404);
    }
}
