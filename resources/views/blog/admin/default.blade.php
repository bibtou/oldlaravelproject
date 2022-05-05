<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<title>@yield('title')</title>

	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="/lte/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="/lte/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
	@if (request()->is('gestion/blog/article/*') or request()->is('gestion/blog/page/*'))
		
	<link rel="stylesheet" href="{{asset('assets/laraberg/css/laraberg.css')}}">
	
	@endif
	
	<style>
	.screen-reader-text { display: none; }
	</style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('blog.home') }}" class="nav-link">Blog</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('resource.index') }}" class="nav-link">Ressources</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/lte/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/lte/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="/lte/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
			<i class="fas fa-th-large"></i></a>
      </li>
		<li>
			<a
				class="nav-link"
				href="#"
				role="button"
				onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
				data-toggle="tooltip"
				data-placement="top"
				title="Se déconnecter"
				>
				<i class="fa fa-power-off"></i>
			</a>
			<form id="logout-form" action="{{ route('logout') }}" method="post" style="display:none">
				@csrf
			</form>
		</li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('blog.admin.home') }}" class="brand-link">
      <!--<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">-->
      <span class="brand-text font-weight-light">BlogAdmin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/lte/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
			   
			<li class="nav-item has-treeview">				
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
						Blog - Article
						<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route('blog.admin.article.create') }}" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Créer</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('blog.admin.article.index') }}" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Liste</p>
							</a>
						</li>
					</ul>
				</li>
			</li>
			
			<li class="nav-item has-treeview">				
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
						Blog - Catégorie
						<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route('blog.admin.category.create') }}" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Créer</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('blog.admin.category.index') }}" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Liste</p>
							</a>
						</li>
					</ul>
				</li>
			</li>
			
			<li class="nav-item has-treeview">				
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
						Ressource - Page
						<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route('blog.admin.resource-page.create') }}" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Créer une page</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('blog.admin.resource-page.index') }}" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Liste des pages</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('blog.admin.resource-block.create') }}" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Créer un bloc</p>
							</a>
						</li>
					</ul>
				</li>
			</li>

			<li class="nav-item has-treeview">				
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
						Utilisateur
						<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="{{ route('blog.admin.user.create') }}" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Créer</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('blog.admin.user.index') }}" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Liste</p>
							</a>
						</li>
					</ul>
				</li>
			</li>
<!--
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Blog
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
-->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">@yield('title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
	  
		@yield('content')

		@include('blog.includes.modals.bootstrap-static')

		@include('blog.includes.modals.bootstrap-static-confirm')
		
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

<?php /*
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
  */ ?>
</div>
<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->

	<!-- jQuery -->
	<script src="/lte/plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="/lte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="/lte/js/adminlte.min.js"></script>

	@if (request()->is('gestion/blog/article/*') or request()->is('gestion/blog/page/*'))
		
	<script src="https://unpkg.com/react@16.8.6/umd/react.production.min.js"></script>
	<script src="https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js"></script>	
	<script src="{{ asset('assets/laraberg/js/laraberg.js') }}"></script>
	<script>
	Laraberg.init('article');
	</script>

	@endif
	
	<script>
		// ADMIN
		// Slugify a string
		// https://lucidar.me/en/web-dev/how-to-slugify-a-string-in-javascript/
		function slugify(str)
		{
			str = str.replace(/^\s+|\s+$/g, '');

			// Make the string lowercase
			str = str.toLowerCase();

			// Remove accents, swap ñ for n, etc
			var from = "ÁÄÂÀÃÅČÇĆĎÉĚËÈÊẼĔȆÍÌÎÏŇÑÓÖÒÔÕØŘŔŠŤÚŮÜÙÛÝŸŽáäâàãåčçćďéěëèêẽĕȇíìîïňñóöòôõøðřŕšťúůüùûýÿžþÞĐđßÆa·/_,:;";
			var to   = "AAAAAACCCDEEEEEEEEIIIINNOOOOOORRSTUUUUUYYZaaaaaacccdeeeeeeeeiiiinnooooooorrstuuuuuyyzbBDdBAa------";
			for (var i=0, l=from.length ; i<l ; i++) {
				str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
			}

			// Remove invalid chars
			str = str.replace(/[^a-z0-9 -]/g, '') 
			// Collapse whitespace and replace by -
			.replace(/\s+/g, '-') 
			// Collapse dashes
			.replace(/-+/g, '-'); 

			return str;
		}

		function alertBox(type, message) {
			switch(type) {
				case 'error':
					type = 'danger';
				break;
				case 'success':
					type = 'success';
				break;
			}

			return `<div class="alert alert-${type}">${message}</div>`;
		}
		


		
		const $inputSlug = jQuery('#input-slug');
		
		jQuery('#title').on('keyup', (event) => {
			if (!$inputSlug.prop('readonly')) {
				$inputSlug.val(slugify(event.currentTarget.value));
			}
		});
		
		jQuery('#disabled-slug').on('click', (event) => {
			if ($inputSlug.prop('readonly')) {
				$inputSlug.prop('readonly', false);
				$(event.currentTarget).removeClass("btn-danger").addClass("btn-primary").html('<i class="fa fa-lock-open" aria-hidden="true"></i>&nbsp;&nbsp;Déverrouiller');
			} else {
				$inputSlug.prop('readonly', true);
				$(event.currentTarget).removeClass("btn-primary").addClass("btn-danger").html('<i class="fa fa-lock" aria-hidden="true"></i>&nbsp;&nbsp;Vérrouiller');
			}
		});
		
		$(document.body).submit((event) => {
			event.preventDefault();

			const form = $(event.target);
			const inputDisabledSlug = form.find('#input-slug');

			sendForm(form, form.attr('action'), form.serializeArray(), form.find('input[name="_token"]').val());
		});
		
		function scrollToElement(element) {
			element.scrollIntoView({
				behavior: 'smooth' 
			});
		}

		function sendFormSuccess(form, response, handlerCallback) {
			let formAlertBox = form.find('.alert');

			if(formAlertBox.length === 0) {
				form.prepend(alertBox('success', ''));
				formAlertBox = form.find('.alert');
			}

			if(response.hasOwnProperty('updated_at') === true) {
				formAlertBox.text('Les données ont bien été mises à jour.');
			} else if(response.hasOwnProperty('created_at')) {
				formAlertBox.text('Les données ont bien été créées.');
			}

			form.find('input, textarea, select').removeClass('border-danger');
			form.find('.text-danger').remove();

			if(handlerCallback instanceof Function) handlerCallback(form, response);

			formAlertBox.attr('class', 'alert alert-success');
		}

		function sendFormError(form, xhr, handlerCallback) {
			const formAlertBox = form.find('.alert');
			const message = "Les données n'ont pas été enregistrées.";

			if(formAlertBox.length === 0) {
				form.prepend(alertBox('error', message));
			}

			if(handlerCallback instanceof Function) handlerCallback(form, xhr);

			formAlertBox.text(message);
		}

		function sendForm(form, url, data, token) {
			$('#staticBackdrop').modal('show');
console.log(data);
			$.ajax({
				url: url,
				method: 'POST',
				data: data,
				success: function(response) {
					setTimeout(function() {
						$('#staticBackdrop').modal('hide');
						sendFormSuccess(form, response, updatePage);
						scrollToElement(document.body);
					}, 1000);
				},
				error:function(xhr) {
					setTimeout(function() {
						$('#staticBackdrop').modal('hide');
						sendFormError(form, xhr, addFormErrorAfterValidation);
						scrollToElement(form[0].querySelector('.text-danger').closest('.block-enclosing'));
					}, 1000);
				}
			});
		}
		
		jQuery('.item-delete').on('click', (event) => {
			event.preventDefault();
			
			jQuery(event.currentTarget)
				.closest('.entry-footer')
				.find('form')
				.submit();
		});

		$(function () {

			$('[data-toggle="tooltip"]').tooltip();
			
			(function() {
				const modalStaticConfirm = $('#staticConfirm');
				let   button = null;

				$('.btn--delete').on('click', event => {
					button = event.currentTarget;
					modalStaticConfirm.modal('show');
				});

				$('.btn--delete-confirm').on('click', event => {
					button.closest('form').submit();
				});

				modalStaticConfirm.on('show.bs.modal', event => {
					event.currentTarget.querySelector('.modal-title').textContent = button.dataset.modalTitleDelete;
					event.currentTarget.querySelector('.modal-body').textContent = button.dataset.modalContentDelete;
				});

				modalStaticConfirm.on('hidden.bs.modal', event => {
					button = null;
				});
			})();
			
		})
	</script>

	@stack('scripts')

</body>
</html>