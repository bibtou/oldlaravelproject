@extends(config('appResource.layouts.main'))

@section('title', '')

@section('content')

		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header">
					<h3>{-- $page->title --}</h3>
					</div>
					<div class="card-body">
					{-- $page->content --}
					</div>
				</div>
			</div>
		</div>

@endsection