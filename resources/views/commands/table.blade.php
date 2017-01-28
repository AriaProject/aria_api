<table class="table table-responsive" id="commands-table">
    <thead>
        <th>Commands</th>
        <th>Description</th>
        <th>Return</th>
        <th>Argc</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($commands as $command)
        <tr>
            <td>{!! $command->commands !!}</td>
            <td>{!! $command->description !!}</td>
            <td>{!! $command->return !!}</td>
            <td>{!! $command->argc !!}</td>
            <td>
                {!! Form::open(['route' => ['commands.destroy', $command->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('commands.show', [$command->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('commands.edit', [$command->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>