@extends('layouts.breadcrumb')

@section('titolo')
Login
@endsection

@section('breadcrumb')
Login
@endsection

@section('content')
    <div class="login-section pt-120 pb-120">
        <div class="container">
            <div class="row d-flex justify-content-center g-4">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="form-wrapper">
                        <div class="form-title">
                            <h3>@lang('labels.login-accedi')</h3>
                            <p>@lang('labels.login-nuovomembro')<a href="{{ url('/') }}/user/signup">@lang('labels.login-registrati')</a></p>
                            <h4 style="color: red" id="errore_login">
                                @if (isset($logged) && !$logged) 
                                    @lang('labels.login-fallito')
                                @endif
                            </h4>
                        </div>
                        <form action="" method="POST" id="form_login" class="w-100">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label for="email_login">@lang('labels.login-email') *</label>
                                        <input type="email" name="email" id="email_login" placeholder="@lang('labels.login-email-placeholder')" required>
                                        <span id="errore_email_login"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label>@lang('labels.login-password') *</label>
                                        <input type="password" name="password" id="password_login" placeholder="@lang('labels.login-password-placeholder')" required/>
                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                        <span id="errore_password_login"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-agreement form-inner d-flex justify-content-between flex-wrap">
                                        <div class="form-group">
                                            <input type="checkbox" name="termini" id="termini_login" >
                                            <label for="termini_login">@lang('labels.login-condizioni') *</label>
                                        </div>
                                        <span id="errore_termini_login"></span>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="account-btn">@lang('labels.login-accedi')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection