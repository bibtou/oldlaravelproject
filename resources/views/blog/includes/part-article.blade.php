<article id="post-{{ $article->id }}<?php //the_ID(); ?>" class="@if ($article->private) private @endif post-content"<?php //post_class( 'post-content' ); ?> >

	<?php /*
	if ( is_sticky() && is_home() && ! is_paged() ) {
		printf( '<span class="sticky-post">%s</span>', __( 'Featured', 'nisarg' ) );
	} */ ?>

	<!-- UNE VUE GERANT L'AFFICHAGE D'UNE IMAGE PEUT ETRE INCLUE -->
	<?php //nisarg_featured_image_disaplay(); ?>

	<header class="entry-header">
		<span class="screen-reader-text"><?php //the_title();?></span>
		<?php //if ( is_single() ) : ?>
			<!--<h1 class="entry-title"><?php //the_title(); ?></h1>-->
		<?php //else : ?>
			<h2 class="entry-title">
				@if (!in_array(request()->route()->getName(), ['blog.article', 'blog.admin.article.show']))
				<a href="{{ route('blog.article', ['article_slug' => $article->slug]) }}" rel="bookmark">{{ $article->title }}</a>
				@else
					{{ $article->title }}
				@endif
			</h2>
		<?php //endif; // is_single() ?>

		<?php //if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<h5 class="entry-date">
				<i class="fa fa-calendar-o"></i> 
				<span rel="bookmark">
					<time class="entry-date">{{ $article->displayed_at }} </time>
				</span>
				<span class="byline">
					<span class="sep"></span>
					<i class="fa fa-user"></i>
					<span class="author vcard">
						<span class="url fn n" rel="author">{{ $article->user->name }}</span>
					</span>
				</span>
				<i class="fa fa-folder-open"></i>
				<span>{{ $category->title ?? $article->category->title }}</span>
				
				@if (request()->route()->getName() == 'blog.admin.article.show')
					<a href="{{ route('blog.admin.article.edit', ['article' => $article->id]) }}"><span class="fa fa-pencil" aria-hidden="true">&nbsp;</span>Editer</a>
				@endif
			<?php //nisarg_posted_on(); ?>
			</h5>
		</div><!-- .entry-meta -->
		<?php //endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<p>
		{{ $article->description }}
		</p>
		
		@if (request()->route()->getName() == 'blog.home' || request()->route()->getName() == 'blog.category')
		<p class="read-more">
			<a class="btn btn-default" href="{{ route('blog.article', ['article_slug' => $article->slug]) }}">Lire<span class="screen-reader-text">Lire</span></a>
		</p>
		@endif
	</div>
	
	@if (request()->route()->getName() == 'blog.article' || request()->route()->getName() == 'blog.admin.article.show')
	
	<div class="entry-content">
	
	{!! $article->article !!}
		<?php /*
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nisarg' ),
				'after'  => '</div>',
			) );
			*/
		?>
	</div><!-- .entry-content -->
	
	@endif
	
	<footer class="entry-footer">
		<?php //nisarg_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->