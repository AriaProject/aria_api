<!-- Commands Field -->
<div class="form-group col-sm-6">
    {!! Form::label('commands', 'Commands:') !!}
    {!! Form::text('commands', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Return Field -->
<div class="form-group col-sm-6">
    {!! Form::label('return', 'Return:') !!}
    {!! Form::text('return', null, ['class' => 'form-control']) !!}
</div>

<!-- Argc Field -->
<div class="form-group col-sm-6">
    {!! Form::label('argc', 'Argc:') !!}
    {!! Form::number('argc', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('commands.index') !!}" class="btn btn-default">Cancel</a>
</div>
