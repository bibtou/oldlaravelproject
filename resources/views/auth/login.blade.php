@extends('blog.layouts.default')

@section('title', "S'identifier")

@section('content-user')
		<div class="card col-md-push-3 col-md-6 col-md-pull-3">
				<div class="card-header">S'identifier</div>
				
				<div class="card-body">
					<form method="POST" action="{{ route('login') }}">
                        @csrf
						
						@if ($errors->any())
						<div class="alert alert-danger" role="alert">
							Impossible de vous identifier...
						</div>
						@endif
						
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right pointer">Identifiant</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right pointer">Mot de passe</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label pointer" for="remember">
                                        Se souvenir de moi !
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-10 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    S'identifier
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Mince... J'ai oublié mon mot de passe 🙄
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
				</div>
		</div>
@endsection
