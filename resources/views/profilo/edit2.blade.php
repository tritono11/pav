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
                    {{ Form::open(array('route' => 'profilo.store', 'class' => 'form-horizontal')) }}
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
                        <div class="form-group {{ $errors->has('d_nascita') ? ' has-error' : '' }}">
                            <label for="d_nascita" class="col-md-2 control-label">@Lang('profilo.d_nascita')</label>
                            <div class="col-md-10">
                                {{ Form::date('d_nascita', $profilo->d_nascita, array('class' => 'form-control') )  }}
                                @if ($errors->has('d_nascita'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('d_nascita') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- Localizzazione nascita -->
                        <div class="form-group {{ $errors->has('t_stato_nascita') ? ' has-error' : '' }}">
                            <label for="t_stato_nascita" class="col-md-2 control-label">@Lang('profilo.t_stato_nascita')</label>
                            <div class="col-md-10">
                                {{ Form::select('t_stato_nascita', ['IT' => 'Italia'], $profilo->t_stato_nascita, array('class' => 'form-control')) }}
                                @if ($errors->has('t_comune_nascita'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_stato_nascita') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_regione_nascita') ? ' has-error' : '' }}">
                            <label for="t_regione_nascita" class="col-md-2 control-label">@Lang('profilo.t_regione_nascita')</label>
                            <div class="col-md-10">
                                {{ Form::select('t_regione_nascita', $regioni, $profilo->t_regione_nascita, array('class' => 'form-control', 'id' => 't_regione_nascita', 'data-url' => '../istat/province/' )) }}
                                @if ($errors->has('t_regione_nascita'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_regione_nascita') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_provincia_nascita') ? ' has-error' : '' }}">
                            <label for="t_provincia_nascita" class="col-md-2 control-label">@Lang('profilo.t_provincia_nascita')</label>
                            <div class="col-md-10">
                                {{ Form::select('t_provincia_nascita', [], $profilo->t_provincia_nascita, array('class' => 'form-control', 'id' => 't_provincia_nascita', 'data-url' => '../istat/comuni/' )) }}
                                @if ($errors->has('t_provincia_nascita'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_provincia_nascita') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_comune_nascita') ? ' has-error' : '' }}">
                            <label for="t_comune_nascita" class="col-md-2 control-label">@Lang('profilo.t_comune_nascita')</label>
                            <div class="col-md-10">
                                {{ Form::select('t_comune_nascita', [], $profilo->t_comune_nascita, array('class' => 'form-control', 'id' => 't_comune_nascita')) }}
                                @if ($errors->has('t_comune_nascita'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_comune_nascita') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <!-- END Localizzazione nascita -->
                        <div class="form-group {{ $errors->has('t_cf') ? ' has-error' : '' }}">
                            <label for="t_cf" class="col-md-2 control-label">@Lang('profilo.t_cf')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_cf',$profilo->t_cf, array('class' => 'form-control', 'maxlength' => '16') )  }}
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
                        <div class="form-group {{ $errors->has('t_indirizzo_res') ? ' has-error' : '' }}">
                            <label for="t_indirizzo_res" class="col-md-2 control-label">@Lang('profilo.t_indirizzo_res') di residenza</label>
                            <div class="col-md-10">
                                {{ Form::text('t_indirizzo_res', $profilo->t_indirizzo_res, array('class' => 'form-control') )  }}
                                @if ($errors->has('t_indirizzo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_indirizzo_res') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_numero_civico_res') ? ' has-error' : '' }}">
                            <label for="t_numero_civico_res" class="col-md-2 control-label">@Lang('profilo.t_numero_civico_res')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_numero_civico_res', $profilo->t_numero_civico_res, array('class' => 'form-control') )  }}
                                @if ($errors->has('t_indirizzo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_numero_civico_res') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_cap_res') ? ' has-error' : '' }}">
                            <label for="t_cap_res" class="col-md-2 control-label">@Lang('profilo.t_cap_res')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_cap_res', $profilo->t_cap_res, array('class' => 'form-control') )  }}
                                @if ($errors->has('t_cap_res'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_cap_res') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_stato_res') ? ' has-error' : '' }}">
                            <label for="t_stato_res" class="col-md-2 control-label">@Lang('profilo.t_stato_res')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_stato_res', $profilo->t_stato_res, array('class' => 'form-control') )  }}
                                @if ($errors->has('t_stato_res'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_stato_res') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_regione_res') ? ' has-error' : '' }}">
                            <label for="t_regione_res" class="col-md-2 control-label">@Lang('profilo.t_regione_res')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_regione_res', $profilo->t_regione_res, array('class' => 'form-control') )  }}
                                @if ($errors->has('t_regione_res'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_regione_res') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group {{ $errors->has('t_provincia_res') ? ' has-error' : '' }}">
                            <label for="t_provincia_res" class="col-md-2 control-label">@Lang('profilo.t_provincia_res')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_provincia_res', $profilo->t_provincia_res, array('class' => 'form-control') )  }}
                                @if ($errors->has('t_provincia_res'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_provincia_res') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('t_comune_res') ? ' has-error' : '' }}">
                            <label for="t_comune_res" class="col-md-2 control-label">@Lang('profilo.t_comune_res')</label>
                            <div class="col-md-10">
                                {{ Form::text('t_comune_res', $profilo->t_comune_res, array('class' => 'form-control') )  }}
                                @if ($errors->has('t_comune_res'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('t_comune_res') }}</strong>
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
