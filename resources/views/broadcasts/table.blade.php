<table class="table table-responsive" id="broadcasts-table">
    <thead>
        <th>Message</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($broadcasts as $broadcast)
        <tr>
            <td>{!! $broadcast->message !!}</td>
            <td>
                {!! Form::open(['route' => ['broadcasts.destroy', $broadcast->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('broadcasts.show', [$broadcast->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('broadcasts.edit', [$broadcast->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>