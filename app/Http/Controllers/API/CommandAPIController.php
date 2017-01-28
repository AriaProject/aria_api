<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCommandAPIRequest;
use App\Http\Requests\API\UpdateCommandAPIRequest;
use App\Models\Command;
use App\Repositories\CommandRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CommandController
 * @package App\Http\Controllers\API
 */

class CommandAPIController extends AppBaseController
{
    /** @var  CommandRepository */
    private $commandRepository;

    public function __construct(CommandRepository $commandRepo)
    {
        $this->commandRepository = $commandRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/commands",
     *      summary="Get a listing of the Commands.",
     *      tags={"Command"},
     *      description="Get all Commands",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Command")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->commandRepository->pushCriteria(new RequestCriteria($request));
        $this->commandRepository->pushCriteria(new LimitOffsetCriteria($request));
        $commands = $this->commandRepository->all();

        return $this->sendResponse($commands->toArray(), 'Commands retrieved successfully');
    }

    /**
     * @param CreateCommandAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/commands",
     *      summary="Store a newly created Command in storage",
     *      tags={"Command"},
     *      description="Store Command",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Command that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Command")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Command"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCommandAPIRequest $request)
    {
        $input = $request->all();

        $commands = $this->commandRepository->create($input);

        return $this->sendResponse($commands->toArray(), 'Command saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/commands/{command}",
     *      summary="Display the specified Command",
     *      tags={"Command"},
     *      description="Get Command",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="command",
     *          description="command string",
     *          type="string",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Command"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function showFromCommand($command)
    {
        /** @var Command $command */
        $c = $this->commandRepository->findByField('commands', $command)->first();
        if (empty($c)) {
            return $this->sendError('Command not found');
        }

        return $this->sendResponse($c->toArray(), 'Command retrieved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/commands/{id}",
     *      summary="Display the specified Command",
     *      tags={"Command"},
     *      description="Get Command",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Command",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Command"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Command $command */
        $command = $this->commandRepository->findWithoutFail($id);

        if (empty($command)) {
            return $this->sendError('Command not found');
        }

        return $this->sendResponse($command->toArray(), 'Command retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCommandAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/commands/{id}",
     *      summary="Update the specified Command in storage",
     *      tags={"Command"},
     *      description="Update Command",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Command",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Command that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Command")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Command"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCommandAPIRequest $request)
    {
        $input = $request->all();

        /** @var Command $command */
        $command = $this->commandRepository->findWithoutFail($id);

        if (empty($command)) {
            return $this->sendError('Command not found');
        }

        $command = $this->commandRepository->update($input, $id);

        return $this->sendResponse($command->toArray(), 'Command updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/commands/{id}",
     *      summary="Remove the specified Command from storage",
     *      tags={"Command"},
     *      description="Delete Command",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Command",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Command $command */
        $command = $this->commandRepository->findWithoutFail($id);

        if (empty($command)) {
            return $this->sendError('Command not found');
        }

        $command->delete();

        return $this->sendResponse($id, 'Command deleted successfully');
    }
}
