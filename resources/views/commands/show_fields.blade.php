<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $command->id !!}</p>
</div>

<!-- Commands Field -->
<div class="form-group">
    {!! Form::label('commands', 'Commands:') !!}
    <p>{!! $command->commands !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $command->description !!}</p>
</div>

<!-- Return Field -->
<div class="form-group">
    {!! Form::label('return', 'Return:') !!}
    <p>{!! $command->return !!}</p>
</div>

<!-- Argc Field -->
<div class="form-group">
    {!! Form::label('argc', 'Argc:') !!}
    <p>{!! $command->argc !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $command->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $command->updated_at !!}</p>
</div>

