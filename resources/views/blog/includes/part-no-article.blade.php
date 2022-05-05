
	<section class="no-results not-found">
		<header class="page-header">
			<span class="screen-reader-text">Aucun contenu</span>
			<h1 class="page-title">Aucun contenu</h1>
		</header><!-- .page-header -->

		<div class="page-content">
			<?php //if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p><?php //printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'nisarg' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php //elseif ( is_search() ) : ?>

				<p><?php //esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'nisarg' ); ?></p>
				<?php //get_search_form(); ?>

			<?php //else : ?>

			@if (request()->is('search'))
				<p>Aucun article ne correspond à votre recherche...</p>
			@else
				<p>Il n'y a pas d'article sur cette page<?php //esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'nisarg' ); ?></p>
			@endif

			<?php //endif; ?>
		</div><!-- .page-content -->
	</section><!-- .no-results -->
