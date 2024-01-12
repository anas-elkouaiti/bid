@extends('layouts.breadcrumb')

@section('titolo')
@lang('labels.prodotto-titolo')
@endsection

@section('breadcrumb')
@lang('labels.prodotto-breadcrumb')
@endsection

@section('content')
    <div class="auction-details-section pt-120">
        <div class="container">
            <div class="row g-4 mb-50">
                <div
                    class="col-xl-6 col-lg-7 d-flex flex-row align-items-start justify-content-lg-start justify-content-center flex-md-nowrap flex-wrap gap-4">
                    <ul class="nav small-image-list d-flex flex-md-column flex-row justify-content-center gap-4">
                        @foreach($prodotto->immagini->take(3) as $immagine)
                            <li class="nav-item">
                                <div id="details-img{{ $loop->iteration }}" data-bs-toggle="pill" data-bs-target="#gallery-img{{ $loop->iteration }}"
                                    aria-controls="gallery-img{{ $loop->iteration }}">
                                    <img alt="image" src="{{ asset($immagine->percorso) }}" class="img-fluid">
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content mb-4 d-flex justify-content-lg-start justify-content-center">
                        @foreach($prodotto->immagini->take(3) as $immagine)
                            <div class="tab-pane big-image fade @if($loop->first) show active @endif" id="gallery-img{{ $loop->iteration }}">
                                @if (!$prodotto->scaduto())
                                <div class="auction-gallery-timer d-flex align-items-center justify-content-center flex-wrap countdown-det"
                                        data-countdown="{{ date('F j, Y H:i:s', strtotime($prodotto->data_scadenza)) }}" id="timer-{{ $prodotto->id }}-{{ $loop->iteration }}">
                                    <h3 id="countdown-timer-{{ $loop->iteration }}">
                                        <span id="days-{{ $prodotto->id }}-{{ $loop->iteration }}">0</span>D 
                                        <span id="hours-{{ $prodotto->id }}-{{ $loop->iteration }}">05</span>H : 
                                        <span id="minutes-{{ $prodotto->id }}-{{ $loop->iteration }}">52</span>M : 
                                        <span id="seconds-{{ $prodotto->id }}-{{ $loop->iteration }}">32</span>S
                                    </h3>
                                </div>
                                @else
                                <div class="auction-gallery-timer d-flex align-items-center justify-content-center flex-wrap"
                                        data-countdown="{{ date('F j, Y H:i:s', strtotime($prodotto->data_scadenza)) }}" id="timer-{{ $prodotto->id }}-{{ $loop->iteration }}">
                                    <h3 id="countdown-timer-{{ $loop->iteration }}">
                                        @lang('labels.card-scaduto')
                                    </h3>
                                </div>
                                @endif
                                <img alt="image" src="{{ asset($immagine->percorso) }}" class="img-fluid">
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-xl-6 col-lg-5">
                    <div class="product-details-right">
                        <h3>{{ $prodotto->titolo }}</h3>
                        <p class="para">
                            @foreach($prodotto->categorie as $categoria)
                                {{ $categoria->nome }} -
                            @endforeach
                        </p>
                        @if (!$prodotto->scaduto())
                            @if (count($prodotto->offerte) == 0)
                                <h4>@lang('labels.prodotto-baseasta'): <span>{{ number_format($prodotto->base_asta, 2) }}€</span></h4>
                            @else
                                <h4>@lang('labels.prodotto-offertaatt'): <span>{{ number_format($prodotto->offerta_alta(), 2) }}€</span></h4>
                            @endif

                            @if (isset($messaggio) && $messaggio != "")
                                <h4>@lang('labels.prodotto-risultato-op')<span class="mt-1 text-danger">{{ $messaggio }}</span></h4>
                            @endif
                        
                            @if (isset($logged) && $logged)
                                <div class="bid-form">
                                    <div class="form-title">
                                        <h5>@lang('labels.prodotto-offriora')</h5>
                                        @if (count($prodotto->offerte) == 0)
                                            <p>@lang('labels.prodotto-offertamin') : {{ number_format($prodotto->offerta_alta(), 2) }}€</p>
                                        @else
                                            <p>@lang('labels.prodotto-offertamin') : {{ number_format($prodotto->offerta_alta() + 1, 2) }}€</p>
                                        @endif
                                    </div>
                                    <form id="form_bid" action="{{ url('/') }}/prodotti/dettaglio/{{ $prodotto->id }}" method="POST">
                                        <div class="form-inner gap-2" id="div_prezzo" data-numofferte="{{ count($prodotto->offerte) }}"
                                                data-prezzo="{{ $prodotto->offerta_alta() }}"
                                                data-utente="{{ $id_utente }}">
                                            @csrf
                                            <input type="hidden" name="prodotto" value="{{ $prodotto->id }}">
                                            <input type="text" name="prezzo" id="prezzo_bid"
                                                @if (count($prodotto->offerte) == 0)
                                                    value="{{ number_format($prodotto->offerta_alta(), 2) }}"
                                                @else
                                                    value="{{ number_format($prodotto->offerta_alta() + 1, 2) }}"
                                                @endif
                                            placeholder="00.00" required>
                                            <button class="eg-btn btn--primary btn--sm" 
                                                @if (!isset($logged) || !$logged || (isset($logged) && $logged && $id_utente == $prodotto->venditore->id))
                                                    disabled
                                                @endif
                                                type="submit">@lang('labels.prodotto-faiofferta')</button>
                                        </div>
                                    </form>
                                    <span id="errore_prezzo_bid"></span>
                                </div>
                            @else
                                <div class="bid-form">
                                    <div class="form-title">
                                        <h5>@lang('labels.prodotto-serveloggarsi')</h5>
                                        <p>@lang('labels.prodotto-haiaccount') <a href="{{ url('/') }}/user/signup"><u>@lang('labels.prodotto-registrati')</u></a></p>
                                    </div>
                                </div>
                            @endif
                        @else
                            <h4>@lang('labels.prodotto-astaconclusa') {{ date('d/m/Y H:i', strtotime($prodotto->data_scadenza)) }}</h4>
                            <br>
                            <div class="bid-form">
                            @if (count($prodotto->offerte) == 0)
                                <h4><b>@lang('labels.prodotto-esito')</b>: @lang('labels.prodotto-nessunaofferta')</h4>
                                <h4><b>@lang('labels.prodotto-baseasta')</b>: {{ number_format($prodotto->base_asta, 2) }}€</h4>
                            @else
                                <h4><b>@lang('labels.prodotto-esito')</b>: @lang('labels.prodotto-aggiudicatoda') {{ '@'.$prodotto->offerta_alta_obj()->esecutore->username }}</h4>
                                <h4><b>@lang('labels.prodotto-offerta')</b>: {{ number_format($prodotto->offerta_alta(), 2) }}€</h4>
                                <h4><b>@lang('labels.prodotto-baseasta')</b>: {{ number_format($prodotto->base_asta, 2) }}€</h4>
                            @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center g-4">
                <div class="col-lg-8">
                    <ul class="nav nav-pills d-flex flex-row justify-content-start gap-sm-4 gap-3 mb-45" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active details-tab-btn" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">@lang('labels.prodotto-descrizione')</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link details-tab-btn" id="pills-bid-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-bid" type="button" role="tab" aria-controls="pills-bid"
                                aria-selected="false">@lang('labels.prodotto-storico')</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link details-tab-btn" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">@lang('labels.prodotto-altreaste')</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active wow fadeInUp" data-wow-duration="1.5s"
                            data-wow-delay=".2s" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                            <div class="describe-content">
                                <h4>@lang('labels.prodotto-descrizione-titolo')</h4>
                                <p class="para">{{ $prodotto->descrizione }}</p>
                                <ul class="describe-list">
                                    <li><a href="#">@lang('labels.prodotto-descrizione-location'): {{ $prodotto->location }}</a></li>
                                    <li><a href="#">@lang('labels.prodotto-descrizione-baseasta'): {{ number_format($prodotto->base_asta, 2) }}€</a></li>
                                    <li><a href="#">@lang('labels.prodotto-descrizione-caricamento'): {{ \Carbon\Carbon::createFromTimeStamp(strtotime($prodotto->data_caricamento))->diffForHumans() }} [{{ date('d/m/Y H:i', strtotime($prodotto->data_caricamento)) }}]</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-bid" role="tabpanel" aria-labelledby="pills-bid-tab">
                            <div class="bid-list-area">
                                <ul class="bid-list">
                                    @forelse($prodotto->offerte as $offerta)
                                        <li>
                                            <div class="row d-flex align-items-center">
                                                <div class="col-7">
                                                    <div class="bidder-area">
                                                        <div class="bidder-img">
                                                            <img alt="image" style="width: 100px; max-height:150px;" src="{{ asset($offerta->esecutore->img_profilo) }}">
                                                        </div>
                                                        <div class="bidder-content">
                                                            <a href="#">
                                                                <h6>{{ '@'.$offerta->esecutore->username }}</h6>
                                                            </a>
                                                            <p>{{ number_format( $offerta->prezzo, 2) }}€</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-5 text-end">
                                                    <div class="bid-time">
                                                        <p>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($offerta->data_esecuzione))->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li>
                                            <div class="row d-flex align-items-center">
                                                <div class="describe-content">
                                                    <h4>@lang('labels.prodotto-storico-noofferte')!</h4>
                                                </div>
                                            </div>
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab">
                            <div class="row d-flex justify-content-center g-4">
                                @foreach($prodotti_consigliati as $prodotto_c)
                                    <div class="col-lg-6 col-md-4 col-sm-10">
                                        <div class="eg-card auction-card1">
                                            <div class="auction-img">
                                                <img alt="image" src="{{ $prodotto_c->immagini[0]->percorso }}">
                                                <div class="auction-timer">
                                                    @if (!$prodotto_c->scaduto())
                                                    <div class="countdown" id="timer-{{ $prodotto_c->id }}" data-countdown="{{ date('F j, Y H:i:s', strtotime($prodotto_c->data_scadenza)) }}">
                                                        <h4>
                                                            <span id="days-{{ $prodotto_c->id }}">0</span>D 
                                                            <span id="hours-{{ $prodotto_c->id }}">05</span>H : 
                                                            <span id="minutes-{{ $prodotto_c->id }}">52</span>M :
                                                            <span id="seconds-{{ $prodotto_c->id }}">32</span>S
                                                        </h4>
                                                    </div>
                                                    @else
                                                    <div class="scaduto" id="timer-{{ $prodotto_c->id }}" data-countdown="{{ date('F j, Y H:i:s', strtotime($prodotto_c->data_scadenza)) }}">
                                                        <h4>
                                                            @lang('labels.card-scaduto')
                                                        </h4>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="auction-content">
                                                <h4><a href="{{ url('/') }}/prodotti/dettaglio/{{ $prodotto_c->id }}">{{ $prodotto_c->titolo_croppato() }}</a></h4>
                                                <p>@lang('labels.card-offerta-attuale')<span>{{ number_format($prodotto_c->offerta_alta(), 2) }}€</span> </p>
                                                <div class="auction-card-bttm">
                                                    <a href="{{ url('/') }}/prodotti/dettaglio/{{ $prodotto_c->id }}" class="eg-btn btn--primary btn--sm">
                                                        @if(!$prodotto_c->scaduto())
                                                            @lang('labels.card-fai-offerta')
                                                        @else
                                                            @lang('labels.card-dettagli')
                                                        @endif
                                                    </a>
                                                    <div class="share-area">
                                                        <div class="author-name">
                                                            <span>@lang('labels.card-autore'){{ '@'.$prodotto_c->venditore->username }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-sidebar">
                        <div class="sidebar-banner">
                            <div class="banner-content">
                                <span>@lang('labels.prodotto-postatada'):</span>
                                <img class="mt-1" src="{{ asset($prodotto->venditore->img_profilo) }}" alt="{{ ucwords($prodotto->venditore->cognome) }} {{ ucwords($prodotto->venditore->nome) }}" width="120px">
                                <h4 class="mt-1">{{ '@'.$prodotto->venditore->username }}</h4>
                                <a href="mailto:{{ $prodotto->venditore->email }}" class="eg-btn btn--primary btn--sm mt-1">@lang('labels.prodotto-contattavenditore')</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="about-us-counter pt-120 pb-120">
        <div class="container">
        </div>
    </div>
@endsection