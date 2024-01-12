@extends('layouts.breadcrumb')

@section('titolo')
@lang('labels.prodotti-titolo')
@endsection

@section('breadcrumb')
@lang('labels.prodotti-breadcrumb')
@endsection

@section('content')
    <div class="live-auction-section pt-120 pb-120">
        <div class="container">
            <form action="" method="GET" id="form_product">
                <div class="row gy-4 mb-60 d-flex justify-content-center">
                    <div class="col-lg-6 col-md-6 col-sm-10">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-10 ">
                                <select id="categoria_product" name="categoria">
                                    <option selected value="">@lang('labels.prodotti-categorie')</option>
                                    @foreach($categorie as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-10 ">
                                <select id="ordinamento_product" name="ordinamento">
                                    <option selected value="">@lang('labels.prodotti-ordinaper')</option>
                                    <option value="prezzo">@lang('labels.prodotti-ordinaper-prezzo')</option>
                                    <option value="scadenza">@lang('labels.prodotti-ordinaper-data')</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-10">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-10 ">
                                <div class="form-check mt-2">
                                    <input name="includi" class="form-check-input" type="checkbox" value="scad" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">@lang('labels.prodotti-includiscaduto')</label>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-10 ">
                                <button type="submit" class="eg-btn btn--primary header-btn">@lang('labels.prodotti-filtra')</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row gy-4 mb-60 d-flex justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-10 ">
                    <h1>@lang('labels.prodotti-titolo-sezione')</h1>
                </div>
            </div>
            <div class="row gy-4 mb-60 d-flex justify-content-center">
                @foreach($prodotti as $prodotto)
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
                                        {{ $categoria->nome }}. 
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
                @endforeach
            </div>
            <div class="row">
                @if($prodotti->hasPages())
                <nav class="pagination-wrap">
                    <ul class="pagination d-flex justify-content-center gap-md-3 gap-2">
                        @if($prodotti->previousPageUrl() != NULL)
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="{{ $prodotti->appends(request()->input())->previousPageUrl() }}" tabindex="-1">
                                Prev
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="{{ $prodotti->appends(request()->input())->previousPageUrl() }}">
                                {{ $prodotti->currentPage() - 1 }}
                            </a>
                        </li>
                        @endif
                        <li class="page-item active">
                            <a class="page-link" href="#">
                                {{ $prodotti->currentPage() }}
                            </a>
                        </li>
                        @if($prodotti->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $prodotti->appends(request()->input())->nextPageUrl() }}">
                                {{ $prodotti->currentPage() + 1 }}
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="{{ $prodotti->appends(request()->input())->nextPageUrl() }}">
                                Next
                            </a>
                        </li>
                        @endif
                    </ul>
                </nav>
                @endif
            </div>
        </div>
    </div>
@endsection