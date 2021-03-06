<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>


	<link href="/css/app.css" rel="stylesheet">
	<link href="/css/style.css" rel="stylesheet">
	<script src="/js/jquery-3.2.0.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>

	<!-- Fonts -->
	{{--<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>--}}

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<!--<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>-->
		<!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">Account</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="/orders/create">调拨单</a></li>
					<li><a href="/debts/create">欠单</a></li>
					<li><a href="/orders">调拨单查询</a></li>
					<li><a href="/debts">欠单查询</a></li>
					<li><a href="/debtors">客户</a></li>
					<li><a href="/incomes">收入</a></li>
					<li><a href="/expenses">支出</a></li>
					<li><a href="/account">账目</a></li>
					<li><a href="/reports">记录</a></li>
					<li><a href="/setting">设置</a></li>
					{{--@if(Auth::user()->permission == 3)--}}
						{{--<li><a href="/account">人员管理</a></li>--}}
					{{--@endif--}}
				</ul>

				<ul class="nav navbar-nav navbar-right">
					{{--<li class="dropdown">--}}
						{{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>--}}
						{{--<ul class="dropdown-menu" role="menu">--}}
							{{--<li><a href="/web/logout">登出</a></li>--}}
						{{--</ul>--}}
					{{--</li>--}}
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')
</body>
</html>
