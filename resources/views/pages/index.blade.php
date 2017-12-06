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
                        <div class="card tooltipped" data-position="bottom" data-delay="50" data-tooltip="ajouté par
                            @foreach($users as $user)
                                    @if($user->id === $plat->user_id)
                                        {{ $user->name }}
                                    @endif
                            @endforeach
                                ">
                            <div class="card-image">
                                <img src="{{ $plat->url }}">
                                @if(Auth::user())
                                    <div class="card-title row animated card-menu-container">
                                        <a onclick="EditPlat({{ $plat->id }})" class="waves-effect waves-light grey btn col m4 center card-menu-item"><i class="material-icons">mode_edit</i></a>
                                        <a onclick="NewNote({{ $plat->id }})" class="waves-effect waves-light green btn col m4 center card-menu-item"><i class="material-icons">note_add</i></a>
                                        <a onclick="ModaleDeletePlat({{ $plat->id }}, '{{ $plat->name }}')" class="waves-effect waves-light red btn col m4 center card-menu-item"><i class="material-icons">delete_forever</i></a>
                                    </div>
                                @endif
                                <span class="card-title black">{{ $plat->name }}</span>
                            </div>
                            <div class="card-action">
                                <p class="nomargin" href="#">Prix : <b>{{ $plat->price }}€</b></p>
                                <p class="nomargin" href="#">Qualité :<br>
                                    @for($i = 0 ; $i < $plat->notes->first()->mark ; $i++)
                                        ⭐
                                    @endfor
                                </p>
                                <p class="nomargin" href="#">Pétage de bide :<br>
                                    @for($i = 0 ; $i < $plat->notes->first()->fat ; $i++)
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
            <a id="add-plat-btn" class="btn-floating btn-large orange darken-4">
                <i class="waves-effect waves-light large material-icons modal-trigger" href="#modal-add" onclick="EmptyModal()">add</i>
            </a>
        </div>
    @endif
</main>

<!-- Modal Structure -->
<div id="modal-add" class="modal bottom-sheet">
    <div class="modal-content">
        <h4 id="title-modal-plat">Un nouveau plat à partager ?</h4>
        <div class="row">
            <form id="form-bottom" class="col s12" action="Create" method="post">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <input class="hidden-plat_id" name="plat_id" type="hidden" value=""/>
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

<div id="modal-add-note" class="modal">
    <div class="modal-content">
        <h4 id="titre-modale-add-note"></h4>
        <div class="row">
            <form class="col s12" action="CreateNote" method="post">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <input id="hidden-plat_id" name="plat_id" type="hidden" value=""/>
                <div class="row">
                    <div class="input-field col m2 s12">
                        <label>Qualité</label>
                    </div>
                    <div class="input-field col m4 s12">
                        <p class="range-field">
                            <input type="range" id="add-mark" min="0" max="5" name="mark" />
                        </p>
                    </div>
                    <div class="input-field col m2 s12">
                        <label>Pétage de bide</label>
                    </div>
                    <div class="input-field col m4 s12">
                        <p class="range-field">
                            <input type="range" id="add-fat" min="0" max="5" name="fat" />
                        </p>
                    </div>
                </div>
                <div class="row">
                    <button class="btn center waves-effect waves-light orange darken-4" type="submit" name="submit">Valider
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modal-delete" class="modal">
    <div class="modal-content center">
        <h4 id="titre-modale-delete-plat"></h4>
        <div class="row">
            <form class="col s12" action="DeletePlat" method="post">
                <input name="_token" type="hidden" value="{{ csrf_token() }}"/>
                <input id="hidden-delete-plat_id" name="id" type="hidden" value=""/>
                <a class="btn col m3 offset-m2 waves-effect waves-light red lighten-1" onclick="$('#modal-delete').modal('close');">Oulah non !</a>
                <button class="btn col m3 offset-m2 waves-effect waves-light green lighten-1" type="submit" name="submit">Sûr de sûr</button>
            </form>
        </div>
    </div>
</div>

<!-- Tap Target Structure -->
<div class="tap-target" data-activates="add-plat-btn">
    <div class="tap-target-content">
        <h5>Title</h5>
        <p>A bunch of text</p>
    </div>
</div>

@endsection