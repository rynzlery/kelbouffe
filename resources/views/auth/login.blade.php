@extends('layouts.master')

@section('content')
<div class="container">
    @if (session('confirmation-success'))
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <div class="card-panel green lighten-2">
                <span class="white-text">
                  {{ session('confirmation-success') }}
                </span>
                </div>
            </div>
        </div>
    @endif

    @if (session('confirmation-danger'))
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <div class="card-panel green lighten-2">
            <span class="white-text">
              {{ session('confirmation-danger') }}
            </span>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col m4 offset-m4">
            <div class="panel panel-default">
                <div class="panel-heading">Connexion</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Adresse E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Mot de passe</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Connexion
                                </button>

                                <!--<a class="btn btn-link" href="{{ route('password.request') }}">
                                    Mot de passe oublié ?
                                </a>-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
