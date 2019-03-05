@extends('layouts.ilowawahome')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 2">
            <div class="panel panel-default">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="/users/list">@Lang('generic.users')</a></li>
                    <li class="active">@Lang('generic.edit')</li>
                  </ol>
                <div class="panel-heading">@Lang('user.edit')</div>
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
                    {{ Form::open(array('route' => array('profilo.update', $user->id), 'class' => 'form-horizontal')) }}
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="t_nome" class="col-md-2 control-label">@Lang('user.name')</label>
                            <div class="col-md-10">
                                {{ Form::text('name', $user->name, array('class' => 'form-control', 'required' => 'required', 'disabled' => 'disabled')) }}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-2 control-label">@Lang('user.email')</label>
                            <div class="col-md-10">
                                {{ Form::text('email', $user->email, array('class' => 'form-control', 'required' => 'required', 'disabled' => 'disabled')) }}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-2 control-label">@Lang('user.roles')</label>
                            <div class="col-md-10">
                                @foreach($user->getRoleNames() as $role)
                                {{$role}}
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-primary disabled">
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
<script type="text/javascript" src="{{ asset('js/profilo.js') }}"></script>
@stop