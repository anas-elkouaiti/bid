@extends('layouts.breadcrumb')

@section('titolo')
@lang('labels.inserisci-titolo')
@endsection

@section('breadcrumb')
@lang('labels.inserisci-breadcrumb')
@endsection

@section('content')
    <div class="dashboard-section pt-120 pb-120">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-8 col-lg-10 col-md-12">
                    <h1>@lang('labels.inserisci-titolo-sezione')</h1>
                    <div class="form-wrapper">
                        <form action="#" method="POST" id="form_create"  enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label for="titolo_create">@lang('labels.inserisci-form-titolo') *</label>
                                        <input type="text" name="titolo" id="titolo_create" placeholder="@lang('labels.inserisci-form-titolo-placeholder')" required>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="form-inner">
                                        <label for="categoria_create">@lang('labels.inserisci-form-categoria') *</label>
                                        <select id="categoria_create" name="categoria" required>
                                            <option value="0" selected disabled>@lang('labels.inserisci-form-categoria-seleziona')</option>
                                            @foreach($categorie as $categoria)
                                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                                            @endforeach
                                        </select>
                                        <span id="errore_categoria_create"></span>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="form-inner">
                                        <b>@lang('labels.inserisci-form-categorie'):</b> 
                                        <p style="font-size: 10px;">(@lang('labels.inserisci-form-categoria-errore'))</p>
                                        <span id="categorie_selezionate"></span>

                                        <input type="hidden" name="categorie_selezionate[]" id="categorie_selezionate_create" value="0">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="form-inner">
                                        <label for="location_create">@lang('labels.inserisci-form-location')</label>
                                        <input type="text" name="location" id="location_create" placeholder="@lang('labels.inserisci-form-location-placeholder')">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label for="descrizione_create">@lang('labels.inserisci-form-descrizione') *</label>
                                        <textarea name="descrizione" id="descrizione_create" placeholder="@lang('labels.inserisci-form-descrizione-placeholder')" rows="12" required></textarea>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-12 col-md-6">
                                    <div class="form-inner">
                                        <label for="base_asta_create">@lang('labels.inserisci-form-baseasta')</label>
                                        <input type="text" name="base_asta" id="base_asta_create" placeholder="00.00€" value="00.00" required>
                                        <span id="errore_base_asta_create"></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label for="data_scadenza_create">@lang('labels.inserisci-form-data')</label>
                                        <input type="datetime-local" name="data_scadenza" id="data_scadenza_create"
                                            min="{{ str_replace(' ', 'T', date('Y-m-d H:i', strtotime(date('Y-m-d H:i') . ' +1 hour'))) }}" 
                                            max="{{ str_replace(' ', 'T', date('Y-m-d H:i', strtotime(date('Y-m-d H:i') . ' +1 month'))) }}" 
                                            value="{{ str_replace(' ', 'T', date('Y-m-d H:i', strtotime(date('Y-m-d H:i') . ' +1 hour'))) }}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label for="img_prodotto_create">@lang('labels.inserisci-form-immagini') (min:1, max:3)</label>
                                        <input type="file" name="img_prodotto[]" id="img_prodotto_create" required multiple>
                                    </div>
                                </div>
                                <input type="reset" value="Reset" style="display:none">
                                <div class="col-12">
                                    <div class="button-group">
                                        <button type="submit" class="eg-btn profile-btn">@lang('labels.inserisci-form-inserisci')</button>
                                        <div class="eg-btn cancel-btn" id="cancella_create">@lang('labels.inserisci-form-reset')</div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection