<table class="table table-responsive" id="viewers-table">
    <thead>
        <th>Username</th>
        <th>Email</th>
        <th>Points</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($viewers as $viewer)
        <tr>
            <td>{!! $viewer->username !!}</td>
            <td>{!! $viewer->email !!}</td>
            <td>{!! $viewer->points !!}</td>
            <td>
                {!! Form::open(['route' => ['viewers.destroy', $viewer->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('viewers.show', [$viewer->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('viewers.edit', [$viewer->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>