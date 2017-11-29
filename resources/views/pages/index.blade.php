@extends('layouts.master')
@section('content')
<main>
	<div class="row">
        @if(Session::has('flash_message'))
            <div class="center col s12 m4 offset-m4"><div class="chip"><i class="close material-icons">close</i><em>{!! session('flash_message') !!}</em></div></div>
        @endif
		<div class="col m10 offset-m1">
			<div class="row">
                @foreach($plats as $plat)
                    <div class="col s12 m2">
                        <div class="card tooltipped" data-position="bottom" data-delay="50" data-tooltip="recommandé par {{ $plat->user_name }}">
                            <div class="card-image">
                                <img src="{{ $plat->url }}">
                                <div class="card-title row animated card-menu-container">
                                    <a href="" class="waves-effect waves-light btn col m4 offset-m1 center card-menu-item"><i class="material-icons">mode_edit</i></a>
                                    <a href="" class="waves-effect waves-light btn col m4 offset-m2 center card-menu-item"><i class="material-icons">note_add</i></a>
                                </div>
                                <span class="card-title black">{{ $plat->name }}</span>
                            </div>
                            <div class="card-action">
                                <p class="nomargin" href="#">Prix : <b>{{ $plat->price }}€</b></p>
                                <p class="nomargin" href="#">Qualité :<br>
                                    @for($i = 0 ; $i < $plat->mark ; $i++)
                                        ⭐
                                    @endfor
                                </p>
                                <p class="nomargin" href="#">Pétage de bide :<br>
                                    @for($i = 0 ; $i < $plat->fat ; $i++)
                                        ⭐
                                    @endfor
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
			</div>
		</div>
	</div>
    @if(Auth::user())
        <div class="fixed-action-btn">
            <a class="btn-floating btn-large orange darken-4">
                <i class="waves-effect waves-light large material-icons modal-trigger" href="#modal-add">add</i>
            </a>
        </div>
    @endif
</main>

<!-- Modal Structure -->
<div id="modal-add" class="modal bottom-sheet">
    <div class="modal-content">
        <h4>Un nouveau plat à partager ?</h4>
        <div class="row">
            <form class="col s12" action="Create" method="post">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <div class="row">
                    <div class="input-field col m4 s12">
                        <input id="name" type="text" class="validate" name="name">
                        <label for="name">Nom du plat</label>
                    </div>
                    <div class="input-field col m2 s12">
                        <input id="price" type="number" step="0.01" class="validate" name="price">
                        <label for="price">Prix</label>
                    </div>
                    <div class="input-field col m1 s12">
                        <label>Qualité</label>
                    </div>
                    <div class="input-field col m2 s12">
                        <p class="range-field">
                            <input type="range" id="mark" min="0" max="5" name="mark" />
                        </p>
                    </div>
                    <div class="input-field col m1 s12">
                        <label>Pétage de bide</label>
                    </div>
                    <div class="input-field col m2 s12">
                        <p class="range-field">
                            <input type="range" id="fat" min="0" max="5" name="fat" />
                        </p>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col m4 s12">
                        <input id="url" type="text" name="url">
                        <label for="url">URL de l'image</label>
                    </div>
                    <!--<div class="input-field col m4 s12">
                        <input id="user_id" type="text" name="user_id">
                        <label for="user_id">Auteur</label>
                    </div>-->
                </div>
                <div class="row">
                    <button class="btn waves-effect waves-light orange darken-4" type="submit" name="submit">Valider
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection