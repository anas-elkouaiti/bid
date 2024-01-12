@extends('layouts.slider')

@section('titolo')
@lang('labels.home-titolo')
@endsection

@section('content')

    <div class="category-section pt-120 pb-120">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center">
                <div class="swiper category1-slider">
                    <div class="swiper-wrapper">
                        @foreach($categorie as $categoria)
                            <div class="swiper-slide">
                                <div class="eg-card category-card1">
                                    <div class="cat-icon">
                                        <img src="{{ asset('images/bg/auction_logo_24.png') }}" alt="{{ $categoria->nome }}">
                                    </div>
                                    <a href="{{ url('/') . '/prodotti?categoria=' . $categoria->id . '&ordinamento=' }}">
                                        <h5>{{ $categoria->nome }}</h5>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="slider-arrows text-center d-lg-flex d-none  justify-content-end">
                <div class="category-prev1 swiper-prev-arrow" tabindex="0" role="button" aria-label="Previous slide"> <i
                        class='bx bx-chevron-left'></i> </div>
                <div class="category-next1 swiper-next-arrow" tabindex="0" role="button" aria-label="Next slide"> <i
                        class='bx bx-chevron-right'></i></div>
            </div>
        </div>
    </div>


    <div class="live-auction pb-120">
        <img alt="image" src="{{ asset('images/bg/section-bg.png') }}" class="img-fluid section-bg">
        <div class="container position-relative">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                    <div class="section-title1">
                        <h2>@lang('labels.home-asta-live')</h2>
                        <p class="mb-0">@lang('labels.home-asta-sottotitolo')</p>
                    </div>
                </div>
            </div>
            <div class="row gy-4 mb-60 d-flex justify-content-center">
                @foreach ($prodotti as $prodotto)
                    <div class="col-lg-4 col-md-6 col-sm-10 ">
                        <div class="eg-card auction-card1">
                            <div class="auction-img">
                                <img alt="image" src="{{ asset($prodotto->immagini[0]->percorso) }}">
                                <div class="auction-timer">
                                    @if (!$prodotto->scaduto())
                                    <div class="countdown" id="timer-{{ $prodotto->id }}" data-countdown="{{ date('F j, Y H:i:s', strtotime($prodotto->data_scadenza)) }}">
                                        <h4>
                                            <span id="days-{{ $prodotto->id }}">0</span>D 
                                            <span id="hours-{{ $prodotto->id }}">05</span>H : 
                                            <span id="minutes-{{ $prodotto->id }}">52</span>M : 
                                            <span id="seconds-{{ $prodotto->id }}">32</span>S
                                        </h4>
                                    </div>
                                    @else
                                    <div class="scaduto" id="timer-{{ $prodotto->id }}">
                                        <h4>
                                            @lang('labels.card-scaduto')
                                        </h4>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="auction-content">
                                <h4><a href="{{ url('/') . '/prodotti/dettaglio/' . $prodotto->id }}">{{ $prodotto->titolo_croppato() }}</a></h4>
                                <p>@lang('labels.card-offerta-attuale')<span>{{ $prodotto->offerta_alta() }}€</span></p>
                                <div class="auction-card-bttm">
                                    <a href="{{ url('/') . '/prodotti/dettaglio/' . $prodotto->id }}" class="eg-btn btn--primary btn--sm">
                                        @if (!$prodotto->scaduto())
                                            @lang('labels.card-fai-offerta')
                                        @else
                                            @lang('labels.card-dettagli')
                                        @endif
                                    </a>
                                    <div class="share-area">
                                        <div class="author-name">
                                            <span>@lang('labels.card-autore'){{ '@'.$prodotto->venditore->username }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-4 text-center">
                    <a href="{{ url('/') . '/prodotti' }}" class="eg-btn btn--primary btn--md mx-auto">@lang('labels.home-mostra-tutti')</a>
                </div>
            </div>
        </div>
    </div>

    @if(isset($logged) && $logged && count($utente->inserzioni) > 0)
    <div class="upcoming-seciton pb-120">
        <img alt="image" src="{{ asset('images/bg/section-bg.png') }}" class="img-fluid section-bg">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-sm-12 col-md-10 col-lg-8 col-xl-6">
                    <div class="section-title1">
                        <h2>@lang('labels.home-inserzioni')</h2>
                        <p class="mb-0">@lang('labels.home-inserzioni-sottotitolo')</p>
                    </div>
                </div>
            </div>
            <div class="row gy-4 mb-60 d-flex justify-content-center">
                @foreach ($utente->inserzioni->take(3) as $prodotto)
                    <div class="col-lg-4 col-md-6 col-sm-10 ">
                        <div class="eg-card auction-card1">
                            <div class="auction-img">
                                <img alt="image" src="{{ asset($prodotto->immagini[0]->percorso) }}">
                                <div class="auction-timer">
                                    @if (!$prodotto->scaduto())
                                    <div class="countdown" id="timer-{{ $prodotto->id }}" data-countdown="{{ date('F j, Y H:i:s', strtotime($prodotto->data_scadenza)) }}">
                                        <h4>
                                            <span id="days-{{ $prodotto->id }}">0</span>D 
                                            <span id="hours-{{ $prodotto->id }}">05</span>H : 
                                            <span id="minutes-{{ $prodotto->id }}">52</span>M : 
                                            <span id="seconds-{{ $prodotto->id }}">32</span>S
                                        </h4>
                                    </div>
                                    @else
                                    <div class="scaduto" id="timer-{{ $prodotto->id }}">
                                        <h4>
                                            @lang('labels.card-scaduto')
                                        </h4>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="auction-content">
                                <h4><a href="{{ url('/') . '/prodotti/dettaglio/' . $prodotto->id }}">{{ $prodotto->titolo_croppato() }}</a></h4>
                                @if (count($prodotto->offerte) > 0)
                                    <p>@lang('labels.card-offerta-attuale')<span>{{ $prodotto->offerta_alta() }}€</span></p>
                                @else 
                                    <p>@lang('labels.card-base-asta')<span>{{ $prodotto->offerta_alta() }}€</span></p>
                                @endif
                                <div class="auction-card-bttm">
                                    <a href="{{ url('/') . '/prodotti/dettaglio/' . $prodotto->id }}" class="eg-btn btn--primary btn--sm">@lang('labels.card-dettagli')</a>
                                    <div class="share-area">
                                        <div class="author-name">
                                            <span>@lang('labels.card-autore'){{ '@'.$prodotto->venditore->username }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-md-4 text-center">
                        <a href="{{ url('/') . '/prodotti' }}" class="eg-btn btn--primary btn--md mx-auto">@lang('labels.home-mostra-tutti')</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    
@endsection