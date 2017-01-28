@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Broadcast
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($broadcast, ['route' => ['broadcasts.update', $broadcast->id], 'method' => 'patch']) !!}

                        @include('broadcasts.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection