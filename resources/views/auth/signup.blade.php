@extends('layouts.breadcrumb')

@section('titolo')
Sign Up
@endsection

@section('breadcrumb')
Sign Up
@endsection

@section('content')
    <div class="signup-section pt-120 pb-120">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="form-wrapper">
                        <div class="form-title">
                            <h3>@lang('labels.signup-registrati')</h3>
                            <p>@lang('labels.signup-haiunaccount')<a href="{{ url('/') }}/user/login">@lang('labels.signup-accedi')</a></p>
                        </div>
                        <form action="" method="POST" id="form_signup" class="w-100" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-inner">
                                        <label for="nome_signup">@lang('labels.signup-nome') *</label>
                                        <input type="text" name="nome" id="nome_signup" placeholder="@lang('labels.signup-nome-placeholder')" required>
                                        <span id="errore_nome_signup"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-inner">
                                        <label for="cognome_signup">@lang('labels.signup-cognome') *</label>
                                        <input type="text" name="cognome" id="cognome_signup" placeholder="@lang('labels.signup-cognome-placeholder')" required>
                                        <span id="errore_cognome_signup"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-inner">
                                        <label for="email_signup">@lang('labels.signup-email') *</label>
                                        <input type="email" name="email" id="email_signup" placeholder="@lang('labels.signup-email-placeholder')" required>
                                        <span id="errore_email_signup"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-inner">
                                        <label for="username_signup">@lang('labels.signup-username') *</label>
                                        <input type="text" name="username" id="username_signup" placeholder="@lang('labels.signup-username-placeholder')" required>
                                        <span id="errore_username_signup"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-inner">
                                        <label for="password_signup">@lang('labels.signup-password') *</label>
                                        <input type="password" name="password" id="password_signup" placeholder="@lang('labels.signup-password-placeholder')" required/>
                                        <i class="bi bi-eye-slash" id="togglePassword_signup"></i>
                                        <span id="errore_password_signup"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-inner">
                                        <label for="file_signup">@lang('labels.signup-immagine')</label>
                                        <input type="file" name="img_profilo" id="file_signup" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-agreement form-inner d-flex justify-content-between flex-wrap">
                                        <div class="form-group">
                                            <input type="checkbox" name="termini" id="termini_signup" >
                                            <label for="termini_signup">@lang('labels.signup-condizioni') *</label>
                                            <span id="errore_termini_signup"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="account-btn">@lang('labels.signup-creaaccount')</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection