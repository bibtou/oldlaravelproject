@if ($paginator->hasPages())
	<nav class="navigation posts-navigation" role="navigation">
		<h2 class="screen-reader-text">Navigation au sein des articles</h2>
		<div class="nav-links">
			<div class="row">
				<div class="col-md-6 next-post">
					@if ($paginator->onFirstPage())
					<span class="disabled" aria-disabled="true">
						<i class="fa fa-angle-double-left"></i>
						ARTICLES PLUS RÉCENTS
					</span>
					@else
					<a href="{{ $paginator->previousPageUrl() }}" rel="prev">
						<i class="fa fa-angle-double-left"></i>
						ARTICLES PLUS RÉCENTS
					</a>
					@endif
				</div>				
				
				
				
				<div class="col-md-6 prev-post">	
					@if ($paginator->hasMorePages())
					<a href="{{ $paginator->nextPageUrl() }}" rel="next">
						ARTICLES PLUS ANCIENS
						<i class="fa fa-angle-double-right"></i>
					</a>
					@else
					<span class="disabled" aria-disabled="true">
						ARTICLES PLUS ANCIENS
						<i class="fa fa-angle-double-right"></i>
					</span>
					@endif
				</div>
			</div>		
		</div><!-- .nav-links -->
	</nav>
@endif