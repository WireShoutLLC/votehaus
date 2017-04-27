<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>votehaus | Vote</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.6 -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" crossorigin="anonymous">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		<!-- X-Editable -->
		<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
		<!-- Theme style -->
		<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		<!-- AdminLTE Skins. We have chosen the skin-blue for this starter
		      page. However, you can choose any other skin. Make sure you
		      apply the skin class to the body tag so the changes take effect.
		-->
		<link rel="stylesheet" href="dist/css/skins/skin-blue.min.css">
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<!-- jQuery 2.2.3 -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
		<!-- JSON Editor -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/json-editor/0.7.28/jsoneditor.min.js"></script>
		<!-- Sortable -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/Sortable/1.5.0/Sortable.min.js"></script>
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
		  		<a href="/vote" class="logo">
			    	<span class="logo-mini"><b>v</b>h</span>
			    	<span class="logo-lg"><b>vote</b>haus</span>
		    	</a>
		
		    	<nav class="navbar navbar-static-top" role="navigation">
		      		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
		        		<span class="sr-only">Toggle navigation</span>
		      		</a>

		      		<div class="navbar-custom-menu">
		        		<ul class="nav navbar-nav">
		          			<li class="dropdown user user-menu">
		            			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		              				<span class="hidden-xs">Voter</span>
		            			</a>
		            			<ul class="dropdown-menu">
		              				<li class="user-header">
		                				<p>Voter</p>
		              				</li>
		              				<li class="user-footer">
		                				<div class="pull-right">
		                  					<a href="/logout" class="btn btn-default btn-flat">Sign out</a>
		                				</div>
		              				</li>
	            				</ul>
		          			</li>
		        		</ul>
		      		</div>
		    	</nav>
		  </header>
