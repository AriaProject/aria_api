@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Command
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($command, ['route' => ['commands.update', $command->id], 'method' => 'patch']) !!}

                        @include('commands.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection