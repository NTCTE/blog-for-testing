<!DOCTYPE html>
<html>
<head>
	<title>OnlyNTCTE | {{ $title ?? 'Главная' }}</title>
	<style>
		header {
			background-color: #333;
			color: #fff;
			padding: 10px;
			display: flex;
			justify-content: space-between;
			align-items: center;
		}

		nav ul {
			list-style: none;
			display: flex;
			align-items: center;
			margin: 0;
			padding: 0;
		}

		nav li {
			margin: 0 10px;
		}

		nav a {
			color: #fff;
			text-decoration: none;
			font-weight: bold;
			font-size: 18px;
			transition: all 0.3s ease;
		}

		nav a:hover {
			color: #f1c40f;
		}

		nav a.active {
			color: #f1c40f
		}
	</style>
</head>
<body>
	<header>
		<div>
			<h1 @auth
				style="margin-bottom: 0;"	
			@endauth
			>Only<s>Fans</s>NTCTE</h1>
			@auth
				<sub>Hello, {{ Auth::user() -> name }}!</sub>
			@endauth
		</div>
		<nav>
			<ul>
				<li><a href="/" @class([
						'active' => request() -> path() === '/'
					])
				])>Home</a></li>
                @auth
					<li><a href="/account" @class([
						'active' => request() -> path() === 'account'
					])>My account</a></li>
                    <li><a href="/blog" @class([
						'active' => request() -> path() === 'blog'
					])>My blog</a></li>
					<li><a href="/exit">Exit</a></li>
                @else
                    <li><a href="/register" @class([
						'active' => request() -> path() === 'register'
					])>Register</a></li>
					<li><a href="/login" @class([
						'active' => request() -> path() === 'login'
					])>Login</a></li>
                @endauth
			</ul>
		</nav>
	</header>
