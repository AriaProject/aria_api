<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBroadcastAPIRequest;
use App\Http\Requests\API\UpdateBroadcastAPIRequest;
use App\Models\Broadcast;
use App\Repositories\BroadcastRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BroadcastController
 * @package App\Http\Controllers\API
 */

class BroadcastAPIController extends AppBaseController
{
    /** @var  BroadcastRepository */
    private $broadcastRepository;

    public function __construct(BroadcastRepository $broadcastRepo)
    {
        $this->broadcastRepository = $broadcastRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/broadcasts",
     *      summary="Get a listing of the Broadcasts.",
     *      tags={"Broadcast"},
     *      description="Get all Broadcasts",
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
     *                  @SWG\Items(ref="#/definitions/Broadcast")
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
        $this->broadcastRepository->pushCriteria(new RequestCriteria($request));
        $this->broadcastRepository->pushCriteria(new LimitOffsetCriteria($request));
        $broadcasts = $this->broadcastRepository->all();

        return $this->sendResponse($broadcasts->toArray(), 'Broadcasts retrieved successfully');
    }

    /**
     * @param CreateBroadcastAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/broadcasts",
     *      summary="Store a newly created Broadcast in storage",
     *      tags={"Broadcast"},
     *      description="Store Broadcast",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Broadcast that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Broadcast")
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
     *                  ref="#/definitions/Broadcast"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBroadcastAPIRequest $request)
    {
        $input = $request->all();

        $broadcasts = $this->broadcastRepository->create($input);

        return $this->sendResponse($broadcasts->toArray(), 'Broadcast saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/broadcasts/{id}",
     *      summary="Display the specified Broadcast",
     *      tags={"Broadcast"},
     *      description="Get Broadcast",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Broadcast",
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
     *                  ref="#/definitions/Broadcast"
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
        /** @var Broadcast $broadcast */
        $broadcast = $this->broadcastRepository->findWithoutFail($id);

        if (empty($broadcast)) {
            return $this->sendError('Broadcast not found');
        }

        return $this->sendResponse($broadcast->toArray(), 'Broadcast retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBroadcastAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/broadcasts/{id}",
     *      summary="Update the specified Broadcast in storage",
     *      tags={"Broadcast"},
     *      description="Update Broadcast",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Broadcast",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Broadcast that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Broadcast")
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
     *                  ref="#/definitions/Broadcast"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBroadcastAPIRequest $request)
    {
        $input = $request->all();

        /** @var Broadcast $broadcast */
        $broadcast = $this->broadcastRepository->findWithoutFail($id);

        if (empty($broadcast)) {
            return $this->sendError('Broadcast not found');
        }

        $broadcast = $this->broadcastRepository->update($input, $id);

        return $this->sendResponse($broadcast->toArray(), 'Broadcast updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/broadcasts/{id}",
     *      summary="Remove the specified Broadcast from storage",
     *      tags={"Broadcast"},
     *      description="Delete Broadcast",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Broadcast",
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
        /** @var Broadcast $broadcast */
        $broadcast = $this->broadcastRepository->findWithoutFail($id);

        if (empty($broadcast)) {
            return $this->sendError('Broadcast not found');
        }

        $broadcast->delete();

        return $this->sendResponse($id, 'Broadcast deleted successfully');
    }
}
