@extends('layouts.ilowawahome')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 2">
            <div class="panel panel-default">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">@Lang('generic.roles')</a></li>
                    <li class="active">@Lang('role.add')</li>
                </ol>
                <div class="panel-heading">@Lang('role.add')</div>
                <div class="panel-body">
                     @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    {{ Form::open(array('route' => 'admin.roles.store', 'class' => 'form-horizontal')) }}
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="t_nome" class="col-md-2 control-label">@Lang('role.name')</label>
                            <div class="col-md-10">
                                {{ Form::text('name', old('name'), array('class' => 'form-control', 'required' => 'required')) }}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('guard_name') ? ' has-error' : '' }}">
                            <label for="guard_name" class="col-md-2 control-label">@Lang('role.guard_name')</label>
                            <div class="col-md-10">
                                {{ Form::text('guard_name', old('guard_name'), array('class' => 'form-control', 'required' => 'required')) }}
                                @if ($errors->has('guard_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('guard_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    @Lang('generic.salva')
                                </button>
                            </div>
                        </div>
                    {{ Form::close()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagescript')
<!-- <script type="text/javascript" src="{{ asset('js/profilo.js') }}"></script>-->
@stop