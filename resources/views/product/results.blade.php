@extends('layouts.breadcrumb')

@section('titolo')
Prodotti
@endsection

@section('breadcrumb')
Risultati Ricerca
@endsection

@section('content')
    <div class="live-auction-section pt-120 pb-120">
        <div class="container">
            <div class="row gy-4 mb-60 d-flex justify-content-center">
                <div class="col-lg-6 col-md-6 col-sm-10 ">
                    <h1>@lang('labels.ricerca-risultatoper') "{{ $testo }}"</h1>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-10 ">
                    <p class="mt-4"><b>@lang('layouts.ricerca-numrisultati')</b>: {{ $prodotti->count() }}</p>
                </div>
            </div>
            <div class="row gy-4 mb-60 d-flex justify-content-center">
                @forelse($prodotti as $prodotto)
                    <div class="col-lg-4 col-md-6 col-sm-10 ">
                        <div class="eg-card auction-card1">
                            <div class="auction-img">
                                <img alt="image" src="{{ asset($prodotto->immagini[0]->percorso) }}">
                                <div class="auction-timer">
                                    @if (!$prodotto->scaduto())
                                    <div class="countdown" id="timer-{{ $prodotto->id }}" data-countdown="{{ date('F j, Y H:i:s', strtotime($prodotto->data_scadenza)) }}">
                                        <h4>
                                            <span id="days-{{ $prodotto->id }}">0</span>D :
                                            <span id="hours-{{ $prodotto->id }}">05</span>H : 
                                            <span id="minutes-{{ $prodotto->id }}">52</span>M : 
                                            <span id="seconds-{{ $prodotto->id }}">32</span>S
                                        </h4>
                                    </div>
                                    @else
                                    <div class="scaduto" id="timer-{{ $prodotto->id }}" data-countdown="{{ date('F j, Y H:i:s', strtotime($prodotto->data_scadenza)) }}">
                                        <h4>
                                            @lang('labels.card-scaduto')
                                        </h4>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="auction-content">
                                <h4><a href="{{ url('/') . '/prodotti/dettaglio/' . $prodotto->id }}">{{ $prodotto->titolo_croppato() }}</a></h4>
                                <div class="c-feature-category">
                                    @foreach($prodotto->categorie as $categoria)
                                        {{ $categoria->nome }}
                                    @endforeach
                                </div>
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
                @empty
                    <h1 class="text-warning p-4">@lang('labels.ricerca-nessunrisultato')</h1>
                @endforelse
            </div>
        </div>
    </div>
@endsection