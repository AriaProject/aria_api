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
                    {!! Form::open(['route' => 'broadcasts.store']) !!}

                        @include('broadcasts.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
