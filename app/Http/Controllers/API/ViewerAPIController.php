<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateViewerAPIRequest;
use App\Http\Requests\API\UpdateViewerAPIRequest;
use App\Models\Viewer;
use App\Repositories\ViewerRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ViewerController
 * @package App\Http\Controllers\API
 */

class ViewerAPIController extends AppBaseController
{
    /** @var  ViewerRepository */
    private $viewerRepository;

    public function __construct(ViewerRepository $viewerRepo)
    {
        $this->viewerRepository = $viewerRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/viewers",
     *      summary="Get a listing of the Viewers.",
     *      tags={"Viewer"},
     *      description="Get all Viewers",
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
     *                  @SWG\Items(ref="#/definitions/Viewer")
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
        $this->viewerRepository->pushCriteria(new RequestCriteria($request));
        $this->viewerRepository->pushCriteria(new LimitOffsetCriteria($request));
        $viewers = $this->viewerRepository->all();

        return $this->sendResponse($viewers->toArray(), 'Viewers retrieved successfully');
    }

    /**
     * @param CreateViewerAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/viewers",
     *      summary="Store a newly created Viewer in storage",
     *      tags={"Viewer"},
     *      description="Store Viewer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Viewer that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Viewer")
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
     *                  ref="#/definitions/Viewer"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateViewerAPIRequest $request)
    {
        $input = $request->all();

        $viewers = $this->viewerRepository->create($input);

        return $this->sendResponse($viewers->toArray(), 'Viewer saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/viewers/{id}",
     *      summary="Display the specified Viewer",
     *      tags={"Viewer"},
     *      description="Get Viewer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Viewer",
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
     *                  ref="#/definitions/Viewer"
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
        /** @var Viewer $viewer */
        $viewer = $this->viewerRepository->findWithoutFail($id);

        if (empty($viewer)) {
            return $this->sendError('Viewer not found');
        }

        return $this->sendResponse($viewer->toArray(), 'Viewer retrieved successfully');
    }

    /**
     * @param int $username
     * @return Response
     *
     * @SWG\Get(
     *      path="/viewers/{username}",
     *      summary="Display the specified Viewer",
     *      tags={"Viewer"},
     *      description="Get Viewer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="username",
     *          description="username of Viewer",
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
     *                  ref="#/definitions/Viewer"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function showFromUsername($username)
    {
        /** @var Viewer $viewer */
        $viewer = Viewer::firstOrCreate(['username' => strtolower($username)]);

        return $this->sendResponse($viewer->toArray(), 'Viewer retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateViewerAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/viewers/{id}",
     *      summary="Update the specified Viewer in storage",
     *      tags={"Viewer"},
     *      description="Update Viewer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Viewer",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Viewer that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Viewer")
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
     *                  ref="#/definitions/Viewer"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateViewerAPIRequest $request)
    {
        $input = $request->all();

        /** @var Viewer $viewer */
        $viewer = $this->viewerRepository->findWithoutFail($id);

        if (empty($viewer)) {
            return $this->sendError('Viewer not found');
        }

        $viewer = $this->viewerRepository->update($input, $id);

        return $this->sendResponse($viewer->toArray(), 'Viewer updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/viewers/{id}",
     *      summary="Remove the specified Viewer from storage",
     *      tags={"Viewer"},
     *      description="Delete Viewer",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Viewer",
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
        /** @var Viewer $viewer */
        $viewer = $this->viewerRepository->findWithoutFail($id);

        if (empty($viewer)) {
            return $this->sendError('Viewer not found');
        }

        $viewer->delete();

        return $this->sendResponse($id, 'Viewer deleted successfully');
    }

    public function increment(Request $request){
        $data = json_decode($request->getContent());

        $number = $data->number;

        foreach ($data->viewers as $v){
            $viewer = Viewer::firstOrCreate(['username' => strtolower($v)]);
            $viewer->points += $number;
            $viewer->save();
        }

        return $this->sendResponse($data, 'Points for viewer increment with success');
    }
}
