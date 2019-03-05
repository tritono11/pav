@extends('layouts.ilowawahome')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 2">
            <div class="panel panel-default">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">@Lang('generic.roles')</a></li>
                    <li class="active">@Lang('generic.lists')</li>
                  </ol>
                <div class="panel-heading">Lista utenti</div>
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Guard</th>
                                <th scope="col">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->guard_name}}</td>
                                <td>
                                    <a href="/roles/edit/{{encrypt($role->id)}}" class="btn btn-primary btn-small">@Lang('generic.edit')</a>
                                    <a href="/roles/delete/{{encrypt($role->id)}}" class="btn btn-danger btn-small">@Lang('generic.delete')</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagescript')
<!-- <script type="text/javascript" src="{{ asset('js/profilo.js') }}"></script>-->
@stop