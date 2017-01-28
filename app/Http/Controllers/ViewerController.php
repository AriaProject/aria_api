<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateViewerRequest;
use App\Http\Requests\UpdateViewerRequest;
use App\Repositories\ViewerRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ViewerController extends AppBaseController
{
    /** @var  ViewerRepository */
    private $viewerRepository;

    public function __construct(ViewerRepository $viewerRepo)
    {
        $this->viewerRepository = $viewerRepo;
    }

    /**
     * Display a listing of the Viewer.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->viewerRepository->pushCriteria(new RequestCriteria($request));
        $viewers = $this->viewerRepository->all();

        return view('viewers.index')
            ->with('viewers', $viewers);
    }

    /**
     * Show the form for creating a new Viewer.
     *
     * @return Response
     */
    public function create()
    {
        return view('viewers.create');
    }

    /**
     * Store a newly created Viewer in storage.
     *
     * @param CreateViewerRequest $request
     *
     * @return Response
     */
    public function store(CreateViewerRequest $request)
    {
        $input = $request->all();

        $viewer = $this->viewerRepository->create($input);

        Flash::success('Viewer saved successfully.');

        return redirect(route('viewers.index'));
    }

    /**
     * Display the specified Viewer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $viewer = $this->viewerRepository->findWithoutFail($id);

        if (empty($viewer)) {
            Flash::error('Viewer not found');

            return redirect(route('viewers.index'));
        }

        return view('viewers.show')->with('viewer', $viewer);
    }

    /**
     * Show the form for editing the specified Viewer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $viewer = $this->viewerRepository->findWithoutFail($id);

        if (empty($viewer)) {
            Flash::error('Viewer not found');

            return redirect(route('viewers.index'));
        }

        return view('viewers.edit')->with('viewer', $viewer);
    }

    /**
     * Update the specified Viewer in storage.
     *
     * @param  int              $id
     * @param UpdateViewerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateViewerRequest $request)
    {
        $viewer = $this->viewerRepository->findWithoutFail($id);

        if (empty($viewer)) {
            Flash::error('Viewer not found');

            return redirect(route('viewers.index'));
        }

        $viewer = $this->viewerRepository->update($request->all(), $id);

        Flash::success('Viewer updated successfully.');

        return redirect(route('viewers.index'));
    }

    /**
     * Remove the specified Viewer from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $viewer = $this->viewerRepository->findWithoutFail($id);

        if (empty($viewer)) {
            Flash::error('Viewer not found');

            return redirect(route('viewers.index'));
        }

        $this->viewerRepository->delete($id);

        Flash::success('Viewer deleted successfully.');

        return redirect(route('viewers.index'));
    }
}
