<?php $current_page = basename($_SERVER['PHP_SELF']); ?>

<div class="navbar-fixed">
	<nav>
		<div class="nav-wrapper orange darken-4">
			<a href="{{ URL::to('/')}}" class="brand-logo center font-barcode">KelBouffeis</a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				@if (!Auth::check())
					<li {{ (Request::is('register') ? 'class=active' : '') }}>
						<a href="{{ URL::to('register')}}" class="navbar-font">S'enregistrer</a>
					</li>
					<li {{ (Request::is('login') ? 'class=active' : '') }}>
						<a href="{{ URL::to('login')}}" class="navbar-font">Connexion</a>
					</li>
				@else
					<li {{ (Request::is('compte') ? 'class=active' : '') }}>
						<a href="{{ URL::to('compte')}}" class="navbar-font">{{Auth::user()->name}}</a>
					</li>
					<li {{ (Request::is('logout') ? 'class=active' : '') }}>
						<a href="{{ URL::to('logout')}}" class="navbar-font">Déconnexion</a>
					</li>
				@endif
			</ul>
		</div>
	</nav>
</div>