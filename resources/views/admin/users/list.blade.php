@extends('layouts.ilowawahome')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12 2">
            <div class="panel panel-default">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Users</a></li>
                    <li class="active">Lista</li>
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
                                <th scope="col">Ruolo</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->getRoleNames()}}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="/users/edit/{{encrypt($user->id)}}" class="btn btn-primary btn-small">@Lang('generic.edit')</a>
                                    <a href="/users/delete/{{encrypt($user->id)}}" class="btn btn-danger btn-small">@Lang('generic.delete')</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('pagescript')
<!-- <script type="text/javascript" src="{{ asset('js/profilo.js') }}"></script>-->
@stop