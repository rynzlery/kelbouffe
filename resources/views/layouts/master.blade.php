<!DOCTYPE html>
<html>
	<head>
		@include('includes.links')
	</head>
	<body>
		@include('layouts.navbar')

		@yield('content')
	</body>

	@include('includes.scripts')
</html>