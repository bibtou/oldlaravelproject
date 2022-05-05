<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Blog - @yield('title')</title>
	
	<!-- a part l'air utilise... -->
	<link rel="stylesheet" id="wp-block-library-css" href="/assets/themes/nisarg/css/dist/block-library/style.min.css?ver=5.4-alpha-47070" type="text/css" media="all">
	
	<link rel="stylesheet" id="font-awesome-css" href="/assets/themes/nisarg/font-awesome/css/font-awesome.min.css" type="text/css" media="all">
	<link rel="stylesheet" id="bootstrap-css" href="/assets/themes/nisarg/css/bootstrap.css">
	<link rel="stylesheet" id="nisarg-style-css" href="/assets/themes/nisarg/css/style.css">
	<style id='nisarg-style-inline-css' type='text/css'>
		/* Color Scheme */
		
		.private {
			border-top: 5px solid #D60000;
		}

		/* Accent Color */

		a:active,
		a:hover,
		a:focus {
			color: #009688;
		}

		.main-navigation .primary-menu > li > a:hover, .main-navigation .primary-menu > li > a:focus {
			color: #009688;
		}
		
		.main-navigation .primary-menu .sub-menu .current_page_item > a,
		.main-navigation .primary-menu .sub-menu .current-menu-item > a {
			color: #009688;
		}
		.main-navigation .primary-menu .sub-menu .current_page_item > a:hover,
		.main-navigation .primary-menu .sub-menu .current_page_item > a:focus,
		.main-navigation .primary-menu .sub-menu .current-menu-item > a:hover,
		.main-navigation .primary-menu .sub-menu .current-menu-item > a:focus {
			background-color: #fff;
			color: #009688;
		}
		.dropdown-toggle:hover,
		.dropdown-toggle:focus {
			color: #009688;
		}

		@media (min-width: 768px){
			.main-navigation .primary-menu > .current_page_item > a,
			.main-navigation .primary-menu > .current_page_item > a:hover,
			.main-navigation .primary-menu > .current_page_item > a:focus,
			.main-navigation .primary-menu > .current-menu-item > a,
			.main-navigation .primary-menu > .current-menu-item > a:hover,
			.main-navigation .primary-menu > .current-menu-item > a:focus,
			.main-navigation .primary-menu > .current_page_ancestor > a,
			.main-navigation .primary-menu > .current_page_ancestor > a:hover,
			.main-navigation .primary-menu > .current_page_ancestor > a:focus,
			.main-navigation .primary-menu > .current-menu-ancestor > a,
			.main-navigation .primary-menu > .current-menu-ancestor > a:hover,
			.main-navigation .primary-menu > .current-menu-ancestor > a:focus {
				border-top: 4px solid #009688;
			}
			.main-navigation ul ul a:hover,
			.main-navigation ul ul a.focus {
				color: #fff;
				background-color: #009688;
			}
		}

		.main-navigation .primary-menu > .open > a, .main-navigation .primary-menu > .open > a:hover, .main-navigation .primary-menu > .open > a:focus {
			color: #009688;
		}

		.main-navigation .primary-menu > li > .sub-menu  li > a:hover,
		.main-navigation .primary-menu > li > .sub-menu  li > a:focus {
			color: #fff;
			background-color: #009688;
		}

		@media (max-width: 767px) {
			.main-navigation .primary-menu .open .sub-menu > li > a:hover {
				color: #fff;
				background-color: #009688;
			}
		}

		.sticky-post{
			background: #009688;
			color:white;
		}
		
		.entry-title a:hover,
		.entry-title a:focus{
			color: #009688;
		}

		.entry-header .entry-meta::after{
			background: #009688;
		}

		.fa {
			color: #009688;
		}

		.btn-default{
			border-bottom: 1px solid #009688;
		}

		.btn-default:hover, .btn-default:focus{
			border-bottom: 1px solid #009688;
			background-color: #009688;
		}

		.nav-previous:hover, .nav-next:hover{
			border: 1px solid #009688;
			background-color: #009688;
		}

		.next-post a:hover,.prev-post a:hover{
			color: #009688;
		}

		.posts-navigation .next-post a:hover .fa, .posts-navigation .prev-post a:hover .fa{
			color: #009688;
		}


		/*#secondary*/ .widget-title::after{
			background-color: #009688;
			content: "";
			position: absolute;
			width: 50px;
			display: block;
			height: 4px;    
			bottom: -15px;
		}

		/*#secondary*/ .widget a:hover,
		/*#secondary*/ .widget a:focus{
			color: #009688;
		}

		/*#secondary*/ .widget_calendar tbody a {
			background-color: #009688;
			color: #fff;
			padding: 0.2em;
		}

		/*#secondary*/ .widget_calendar tbody a:hover{
			background-color: #009688;
			color: #fff;
			padding: 0.2em;
		}
		
		.pointer {
			cursor:pointer;
		}
		
		.card-header, .card-body {
			background: #FFF;
			padding: 20px;
		}
		
		.card-body {
			margin-bottom: 20px;
		}
		
		input.is-invalid, textarea.is-invalid {
			outline: 1px solid red;
		}

	</style>

	<link rel='stylesheet' id='nisarggooglefonts-css'  href='//fonts.googleapis.com/css?family=Lato:400,300italic,700|Source+Sans+Pro:400,400italic' type='text/css' media='all' />

	@if (request()->is('gestion/blog/article/*'))
		
	<link rel="stylesheet" href="{{asset('assets/laraberg/css/laraberg.css')}}">
	
	@endif

</head>

<body>
	<div id="page" class="hfeed site">
		<header id="masthead"  role="banner">
			<nav id="site-navigation" class="main-navigation navbar-fixed-top navbar-left" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="container" id="navigation_menu">
					<div class="navbar-header">
						<button type="button" class="menu-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span> 
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="{{ route('blog.home') }}">Blog</a>
					</div><!-- .navbar-header -->
							
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul id="menu-menu-1" class="primary-menu nav-menu" aria-expanded="false">
							<li class="menu-item menu-item-type-custom menu-item-object-custom  menu-item-home  @if (request()->route()->getName() == 'blog.home') current-menu-item @endif">
								<a href="{{ route('blog.home') }}">Accueil</a>
							</li>
							<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-7">
								<a href="">Page d’exemple</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
			
			<div id="cc_spacer"></div><!-- used to clear fixed navigation by the themes js -->
			
			<div class="site-header">
				<div class="site-branding">
					<a class="home-link" href="{{ route('blog.home') }}" title="<?php //echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<h1 class="site-title"><?php //bloginfo( 'name' ); ?>Blog</h1>
						<h2 class="site-description">Un blog de plus sur le développement web<?php //bloginfo( 'description' ); ?></h2>
					</a>
				</div><!--.site-branding-->
			</div><!--.site-header-->
		</header>
		
		<div id="content" class="site-content">
			<div class="container">
				
				@if (request()->is('gestion/*'))
				<div class="row">
					<!--<div class="col-md-3 sidebar widget-area" role="complementary">-->
						<aside class="col-md-4 widget">
							<h3 class="widget-title">Article</h3>
							<ul>
								<li><a href="{{ route('blog.admin.article.index') }}">Lister</a></li>
								<li><a href="{{ route('blog.admin.article.create') }}">Créer</a></li>
							</ul>
						</aside>
						<aside class="col-md-4 widget">
							<h3 class="widget-title">Catégorie</h3>
							<ul>
								<li><a href="{{ route('blog.admin.category.index') }}">Lister</a></li>
								<li><a href="{{ route('blog.admin.category.create') }}">Créer</a></li>
							</ul>
						</aside>
						<aside class="col-md-4 widget">
							<h3 class="widget-title">Utilisateur</h3>
							<ul>
								<li><a href="{{ route('blog.admin.user.index') }}">Lister</a></li>
								<li><a href="{{ route('blog.admin.user.create') }}">Créer</a></li>
							</ul>
						</aside>
					<!--</div>-->
				</div>
				
				<div class="row">
					<div class="col-md-12">
					@yield('content-admin')
					</div>
					

				</div>
				@elseif (request()->is('login') || request()->is('register'))
				<div class="row">
					@yield('content-user')
				</div>
				@else
				<div class="row">
					@auth
					@if (request()->route()->getName() == 'blog.home' || request()->route()->getName() == 'blog.archive' || request()->route()->getName() == 'blog.category')
					<div class="col-md-12">
						<div class="site-main" style="background:white;margin-bottom: 30px; padding: 10px">
							<form id="form-change-status">
								<label for="article-list">Afficher les articles</label>
								<select id="article-list">
									<option value="-1">Publics et privés</option>
									<option value="0">Publics</option>
									<option value="1">Privés</option>
								</select>
								<input type="hidden" name="type" value=""><!-- home, categorie - lister les articles correspondants -->
							</form>
						</div>
					</div>
					@endif
					@endauth
					<!-- CONTENU PRINCIPAL -->
					<div id="primary" class="col-md-9 content-area">
						<main id="main" class="site-main" role="main">
						
						
						<?php //if ( have_posts() ) : ?>
							<?php //if ( is_home() && ! is_front_page() ) : ?>
								<header>
									<h1 class="page-title screen-reader-text"><?php //single_post_title(); ?>Page / Post title</h1>
								</header>
							<?php //endif; ?>

							<?php /* Start the Loop */ ?>
							<?php //while ( have_posts() ) : the_post(); ?>
								<?php
								/*
								 * If you want to disaplay only excerpt, file content-excerpt.php will be used.
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								 
								 /*
								$post_display_option = get_theme_mod( 'post_display_option', 'post-excerpt' );
								if ( 'post-excerpt' === $post_display_option ) {
									get_template_part( 'template-parts/content','excerpt' );
								} else {
									get_template_part( 'template-parts/content', get_post_format() );
								}
								*/
								?>
							<?php //endwhile; ?>
							
							@yield('content')
							
							<?php //nisarg_posts_navigation(); ?>
						<?php //else : // PAGE SI PAS DE CONTENU ?>
							<?php //get_template_part( 'template-parts/content', 'none' ); ?>
						<?php //endif; ?>
						
						
						</main><!-- #main -->
					</div><!-- #primary -->

					<!-- MENU SUR LE COTE -->
					<div id="secondary" class="col-md-3 sidebar widget-area" role="complementary">
						<aside id="search" class="widget widget_search">
							<form role="search" method="get" class="search-form" action="{{ route('blog.search') }}">
								<label>
									<span class="screen-reader-text">Search for:</span>
									<input type="search" class="search-field" placeholder="Search …" value="" name="s" title="Search for:">
								</label>
								<button type="submit" class="search-submit"><span class="screen-reader-text">Search</span></button>
							</form>
						</aside>
						
						<aside id="categories" class="widget">
							<h3 class="widget-title"> CATEGORIES</h3>
							<ul>
								@foreach ($categories_with_total_article_published ?? [] as $category)
								<li><a href="{{ route('blog.category', ['category_slug' => $category->slug]) }}">( {{ $category->articles_count }} ) - {{ $category->title }}</a></li>
								@endforeach
							</ul>
						</aside>
						
						<aside id="archives" class="widget">
							<h3 class="widget-title"> ARCHIVES</h3>
							<ul>
								@foreach ($archives_with_total_article_published ?? [] as $archive)
								<li><a href="{{ route('blog.archive', ['year' => $archive->displayed_at_year, 'month' => $archive->displayed_at_month ]) }}">( {{ $archive->articles_count }} ) - {{ $archive->month_name }} {{ $archive->displayed_at_year }}</a></li>
								@endforeach
							</ul>
						</aside>
					</div><!-- #secondary .widget-area -->
				</div>
				@endif
				
			</div>
		</div><!-- #content -->
	
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info">
			<?php /*
				<?php //echo '&copy; '.date( 'Y' ); ?>
				<span class="sep"> | </span>
				<?php //printf( esc_html__( 'Proudly Powered by ','nisarg' ) ); ?>
				<!--<a href=" <?php //echo esc_url( __( 'https://wordpress.org/', 'nisarg' ) ); ?>" >WordPress</a>-->
				<span class="sep"> | </span>
				<?php
				/*
				$nisarg_theme_url_str = '<a href="'.esc_url( 'https://wordpress.org/themes/nisarg/' ).'" rel="designer">Nisarg</a>';
				printf( esc_html__( 'Theme: %1$s', 'nisarg' ), $nisarg_theme_url_str );
				*/
				?>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

<?php //wp_footer(); ?>

	<script type='text/javascript' src='/assets/themes/nisarg/js/jquery/jquery.js?ver=1.12.4-wp'></script>
	<script type='text/javascript' src='/assets/themes/nisarg/js/jquery/jquery-migrate.min.js?ver=1.4.1'></script>
	<!--[if lt IE 9]>
	<script type='text/javascript' src='/assets/themes/nisarg/js/html5shiv.js?ver=3.7.3'></script>
	<![endif]-->
	<script type='text/javascript' src='/assets/themes/nisarg/js/bootstrap.js?ver=5.4-alpha-47070'></script>
	<script type='text/javascript' src='/assets/themes/nisarg/js/navigation.js?ver=5.4-alpha-47070'></script>
	<script type='text/javascript' src='/assets/themes/nisarg/js/skip-link-focus-fix.js?ver=5.4-alpha-47070'></script>
	<script type='text/javascript'>
	/* <![CDATA[ */
	let screenReaderText = {"expand":"expand child menu","collapse":"collapse child menu"};
	/* ]]> */
	</script>
	<script type='text/javascript' src='/assets/themes/nisarg/js/nisarg.js?ver=5.4-alpha-47070'></script>
	<script type='text/javascript' src='/assets/themes/nisarg/js/wp-embed.min.js?ver=5.4-alpha-47070'></script>
	
	@if (request()->is('gestion/blog/article/*'))
		
	<script src="https://unpkg.com/react@16.8.6/umd/react.production.min.js"></script>
	<script src="https://unpkg.com/react-dom@16.8.6/umd/react-dom.production.min.js"></script>	
	<script src="{{ asset('assets/laraberg/js/laraberg.js') }}"></script>
	<script>Laraberg.init('article');</script>
	@endif
	
	<script>
		jQuery('#form-change-status').on('change', function(event) {
			const status = jQuery(this).find('option:selected').val();
			console.log(status);
			
			jQuery.ajax({
				url: "{{ route('blog.article-by-status') }}",
				data: { status: status },
				dataType: "html",
				method: 'post',
				headers: {
					'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
				}
			}).done(function(html) {
				location.href = "{{ request()->path() == "/" ? "/" : "/" . request()->path() }}";
				// jQuery('#main').replaceWith( jQuery('#main', html).html() );
				
				// console.log(status);
			});
		});
		
		
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

		
		const $inputSlug = jQuery('#input-slug');
		
		jQuery('#title').on('keyup', (event) => {
			if (!$inputSlug.prop('disabled')) {
				$inputSlug.val(slugify(event.currentTarget.value));
			}
		});
		
		jQuery('#disabled-slug').on('click', (event) => {
			if ($inputSlug.prop('disabled')) {
				$inputSlug.prop('disabled', false);
			} else {
				$inputSlug.prop('disabled', true);
			}
		});
		
		jQuery('.item-delete').on('click', (event) => {
			event.preventDefault();
			
			jQuery(event.currentTarget)
				.closest('.entry-footer')
				.find('form')
				.submit();
		});
	</script>
</body>
</html>