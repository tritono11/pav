@extends('layouts.ilowawahome')

@section('content')
{{-- var_dump($profilo) --}}
<div class="container">
    <div class="row">
        <div class="col-md-12 2">
            <div class="panel panel-default">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Profilo</a></li>
                    <li class="active">Modifica</li>
                  </ol>
                <div class="panel-heading">Modifica profilo</div>
                
                <div class="alert alert-info guida-miniatura" role="alert">Per usufruire del servizio è necessario compilare le informazioni sul tuo profilo.</div>
                
                
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
                    {{ Form::open(array('route' => array('profilo.update', $profilo->id), 'class' => 'form-horizontal')) }}
                        <div class="form-group {{ $errors->has('t_nome') ? ' has-error' : '' }}">
                            <label for="t_nome" class="col-md-2 control-label">@Lang('profilo.nome')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_nome', $profilo->t_nome, array('class' => 'form-control', 'required' => 'required')) }}
                                @if ($errors->has('t_nome'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_nome') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_cognome') ? ' has-error' : '' }}">
                            <label for="t_cognome" class="col-md-2 control-label">@Lang('profilo.cognome')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_cognome', $profilo->t_cognome, array('class' => 'form-control', 'required' => 'required')) }}
                                @if ($errors->has('t_cognome'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_cognome') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_sesso') ? ' has-error' : '' }}">
                            <label for="t_sesso" class="col-md-2 control-label">@Lang('profilo.sesso')</label>
                            <div class="col-md-10">
                                {{ Form::select('t_sesso', array('M' => __('profilo.sesso.maschio'), 'F' => __('profilo.sesso.femmina')), $profilo->t_sesso, array('class' => 'form-control')) }}
                                @if ($errors->has('t_sesso'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_sesso') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_cognome') ? ' has-error' : '' }}">
                            <label for="d_nascita" class="col-md-2 control-label">@Lang('profilo.d_nascita')</label>
                            <div class="col-md-10">
                                {{ Form::date('d_nascita', Carbon\Carbon::parse($profilo->d_nascita)->format('Y-m-d'), array('class' => 'form-control') )  }}
                                @if ($errors->has('d_nascita'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('d_nascita') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_cognome') ? ' has-error' : '' }}">
                            <label for="t_comune_nascita" class="col-md-2 control-label">@Lang('profilo.t_comune_nascita')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_comune_nascita', $profilo->t_comune_nascita, array('class' => 'form-control', 'maxlength' => '2') )  }}
                                {{ Form::select('t_comune_nascita', $comuni, $profilo->t_comune_nascita, array('class' => 'form-control')) }}
                                @if ($errors->has('t_comune_nascita'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_comune_nascita') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_cf') ? ' has-error' : '' }}">
                            <label for="t_cf" class="col-md-2 control-label">@Lang('profilo.t_cf')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_cf', $profilo->t_cf, array('class' => 'form-control', 'maxlength' => '16') )  }}
                                @if ($errors->has('t_cf'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_cf') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_piva') ? ' has-error' : '' }}">
                            <label for="t_piva" class="col-md-2 control-label">@Lang('profilo.t_piva')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_piva', $profilo->t_piva, array('class' => 'form-control', 'maxlength' => '11') )  }}
                                @if ($errors->has('t_piva'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_piva') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_ci') ? ' has-error' : '' }}">
                            <label for="t_ci" class="col-md-2 control-label">@Lang('profilo.t_ci')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_ci', $profilo->t_ci, array('class' => 'form-control') )  }}
                                @if ($errors->has('t_ci'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_ci') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_patente') ? ' has-error' : '' }}">
                            <label for="t_patente" class="col-md-2 control-label">@Lang('profilo.t_patente')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_patente', $profilo->t_patente, array('class' => 'form-control') )  }}
                                @if ($errors->has('t_patente'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_patente') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_telefono') ? ' has-error' : '' }}">
                            <label for="t_telefono" class="col-md-2 control-label">@Lang('profilo.t_telefono')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_telefono', $profilo->t_telefono, array('class' => 'form-control') )  }}
                                @if ($errors->has('t_telefono'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_indirizzo') ? ' has-error' : '' }}">
                            <label for="t_indirizzo" class="col-md-2 control-label">@Lang('profilo.t_indirizzo') di residenza</label>
                            <div class="col-md-10">
                                {{ Form::text('t_indirizzo', $profilo->t_indirizzo, array('class' => 'form-control') )  }}
                                @if ($errors->has('t_indirizzo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_indirizzo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_numero_civico') ? ' has-error' : '' }}">
                            <label for="t_numero_civico" class="col-md-2 control-label">@Lang('profilo.t_numero_civico')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_numero_civico', $profilo->t_numero_civico, array('class' => 'form-control') )  }}
                                @if ($errors->has('t_indirizzo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_numero_civico') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_cap') ? ' has-error' : '' }}">
                            <label for="t_cap" class="col-md-2 control-label">@Lang('profilo.t_cap')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_cap', $profilo->t_cap, array('class' => 'form-control') )  }}
                                @if ($errors->has('t_cap'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_cap') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_comune') ? ' has-error' : '' }}">
                            <label for="t_comune" class="col-md-2 control-label">@Lang('profilo.t_comune')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_comune', $profilo->t_comune, array('class' => 'form-control') )  }}
                                @if ($errors->has('t_comune'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_comune') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_provincia') ? ' has-error' : '' }}">
                            <label for="t_provincia" class="col-md-2 control-label">@Lang('profilo.t_provincia')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_provincia', $profilo->t_provincia, array('class' => 'form-control') )  }}
                                @if ($errors->has('t_provincia'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_provincia') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_regione') ? ' has-error' : '' }}">
                            <label for="t_regione" class="col-md-2 control-label">@Lang('profilo.t_regione')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_regione', $profilo->t_regione, array('class' => 'form-control') )  }}
                                @if ($errors->has('t_regione'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_regione') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_stato') ? ' has-error' : '' }}">
                            <label for="t_stato" class="col-md-2 control-label required">@Lang('profilo.t_stato')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_stato', $profilo->t_stato, array('class' => 'form-control') )  }}
                                @if ($errors->has('t_stato'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_stato') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('b_privacy') ? ' has-error' : '' }}">
                            <label for="b_privacy" class="col-md-2 control-label required">@Lang('profilo.b_privacy')</label>
                            <div class="col-md-10">
                                {{ Form::checkbox('b_privacy', 'value', $profilo->b_privacy)  }}
                                @if ($errors->has('b_privacy'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('b_privacy') }}</strong>
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
