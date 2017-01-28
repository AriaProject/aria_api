<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommandRequest;
use App\Http\Requests\UpdateCommandRequest;
use App\Repositories\CommandRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CommandController extends AppBaseController
{
    /** @var  CommandRepository */
    private $commandRepository;

    public function __construct(CommandRepository $commandRepo)
    {
        $this->commandRepository = $commandRepo;
    }

    /**
     * Display a listing of the Command.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->commandRepository->pushCriteria(new RequestCriteria($request));
        $commands = $this->commandRepository->all();

        return view('commands.index')
            ->with('commands', $commands);
    }

    /**
     * Show the form for creating a new Command.
     *
     * @return Response
     */
    public function create()
    {
        return view('commands.create');
    }

    /**
     * Store a newly created Command in storage.
     *
     * @param CreateCommandRequest $request
     *
     * @return Response
     */
    public function store(CreateCommandRequest $request)
    {
        $input = $request->all();

        $command = $this->commandRepository->create($input);

        Flash::success('Command saved successfully.');

        return redirect(route('commands.index'));
    }

    /**
     * Display the specified Command.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $command = $this->commandRepository->findWithoutFail($id);

        if (empty($command)) {
            Flash::error('Command not found');

            return redirect(route('commands.index'));
        }

        return view('commands.show')->with('command', $command);
    }

    /**
     * Show the form for editing the specified Command.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $command = $this->commandRepository->findWithoutFail($id);

        if (empty($command)) {
            Flash::error('Command not found');

            return redirect(route('commands.index'));
        }

        return view('commands.edit')->with('command', $command);
    }

    /**
     * Update the specified Command in storage.
     *
     * @param  int              $id
     * @param UpdateCommandRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCommandRequest $request)
    {
        $command = $this->commandRepository->findWithoutFail($id);

        if (empty($command)) {
            Flash::error('Command not found');

            return redirect(route('commands.index'));
        }

        $command = $this->commandRepository->update($request->all(), $id);

        Flash::success('Command updated successfully.');

        return redirect(route('commands.index'));
    }

    /**
     * Remove the specified Command from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $command = $this->commandRepository->findWithoutFail($id);

        if (empty($command)) {
            Flash::error('Command not found');

            return redirect(route('commands.index'));
        }

        $this->commandRepository->delete($id);

        Flash::success('Command deleted successfully.');

        return redirect(route('commands.index'));
    }
}
