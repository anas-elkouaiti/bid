@extends('layouts.breadcrumb')

@section('titolo')
@lang('labels.contattaci-titolo')
@endsection

@section('breadcrumb')
@lang('labels.contattaci-breadcrumb')
@endsection

@section('content')
    <div class="contact-section pt-120 pb-120">
        <div class="container">
            <div class="row pb-120 mb-70 g-4 d-flex justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="contact-signle hover-border1 d-flex flex-row align-items-center">
                        <div class="icon">
                            <i class='bx bx-phone-call'></i>
                        </div>
                        <div class="text">
                            <h4>@lang('labels.contattaci-telefono')</h4>
                            <a href="tel:+393333333333">+39 3333333333</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="contact-signle hover-border1 d-flex flex-row align-items-center">
                        <div class="icon">
                            <i class='bx bx-envelope'></i>
                        </div>
                        <div class="text">
                            <h4>@lang('labels.contattaci-email')</h4>
                            <a href="mailto:info@bid.com"><span class="__cf_email__">info@bid.com</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="form-wrapper">
                        <div class="form-title2">
                            @if (isset($messaggio_inviato) && $messaggio_inviato)
                                <h3 style="color:red">@lang('labels.contattaci-confermato')</h3>
                            @else
                                <h3>@lang('labels.contattaci-scrivici')</h3>
                            @endif
                            <p class="para">@lang('labels.contattaci-paragrafo')</p>
                        </div>
                        <form action="#" method="POST" id="form_contact">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="form-inner">
                                        <input type="text" name="nome" id="nome_contact" placeholder="@lang('labels.contattaci-nome-placeholder')" 
                                            @if (isset($logged) && $logged)
                                                value="{{ $nome_utente }}" readonly
                                            @endif
                                        >
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="form-inner">
                                        <input type="email" name="email" id="email_contact" placeholder="@lang('labels.contattaci-email-placeholder')"
                                            @if (isset($logged) && $logged)
                                                value="{{ $email_utente }}" readonly
                                            @endif
                                        >
                                        <span id="errore_email_contact"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="form-inner">
                                        <input type="text" name="telefono" id="telefono_contact" placeholder="@lang('labels.contattaci-telefono-placeholder')">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="form-inner">
                                        <input type="text" name="oggetto" id="oggetto_contact" placeholder="@lang('labels.contattaci-oggetto-placeholder')" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea name="messaggio" id="messaggio_contact" placeholder="@lang('labels.contattaci-messaggio-placeholder')" rows="12" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="eg-btn btn--primary btn--md form--btn">@lang('labels.contattaci-invia-messaggio')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> 
                <div class="col-lg-6">
                    @if ($isChrome)
                        <div class="map-area">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d44777.13121667443!2d9.884881482139834!3d45.45830639968108!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478114bbf846d931%3A0xe09a9ff3abd18531!2s25030%20Roccafranca%20BS!5e0!3m2!1sit!2sit!4v1662392251351!5m2!1sit!2sit"
                                style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection