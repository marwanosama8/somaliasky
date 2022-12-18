@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12 mx-auto text-start px-3 mt-3" style="">
        <div class="col-12 p-4 align-items-center justify-content-center" style="height:100vh">
            <div class="col-12 col-lg-5 mx-auto card p-2 p-lg-4" style="border: none; background-color:transparent;">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    {{csrf_field()}}
                    <div class="card-body">
                        <h2 class="text-center mb-3">{{ __('lang.Enter Password') }}</h2>
                        <div class="form-group row">
                            <div class="col-12">
                                <input type="password" class="form-control text-center @error('email') is-invalid @enderror" placeholder="{{ __('lang.Current Password') }}" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
                                <input type="hidden" name="email" value="{{$user->email}}">
                                @error('email')

                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn py-2 px-5 btn-primary">
                            {{ __('lang.Login') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
