@extends('layouts.breadcrumb')

@section('titolo')
@lang('labels.dashboard-titolo')
@endsection

@section('breadcrumb')
@lang('labels.dashboard-breadcrumb')
@endsection

@section('content')
    @if (isset($logged) && $logged)
    <div class="dashboard-section pt-120 pb-120">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3">
                    <div class="nav flex-column nav-pills gap-4" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link 
                            @if (!isset($messaggio) || empty($messaggio))
                                active 
                            @endif
                            nav-btn-style mx-auto  mb-20" id="v-pills-dashboard-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-dashboard" type="button" role="tab"
                            aria-controls="v-pills-dashboard" aria-selected="true">@lang('labels.dashboard-dashboard')</button>
                        <button class="nav-link
                            @if (isset($messaggio) && !empty($messaggio))
                                active
                            @endif
                            nav-btn-style mx-auto mb-20" id="v-pills-profile-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab"
                            aria-controls="v-pills-profile" aria-selected="true"><i class="lar la-user"></i>@lang('labels.dashboard-profilo')</button>
                        <button class="nav-link nav-btn-style mx-auto mb-20" id="v-pills-order-tab"
                            data-bs-toggle="pill" data-bs-target="#v-pills-order" type="button" role="tab"
                            aria-controls="v-pills-order" aria-selected="true">@lang('labels.dashboard-offerte')</button>
                        <button class="nav-link nav-btn-style mx-auto" id="v-pills-purchase-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-purchase" type="button" role="tab" aria-controls="v-pills-purchase"
                            aria-selected="true">@lang('labels.dashboard-inserzioni')</button>
                        <a href="{{ url('/') }}/user/logout"><button class="nav-link nav-btn-style mx-auto" type="button" role="tab">@lang('labels.dashboard-logout')</button></a>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade 
                            @if (!isset($messaggio) || empty($messaggio))
                                show active
                            @endif
                            " id="v-pills-dashboard" role="tabpanel"
                            aria-labelledby="v-pills-dashboard-tab">
                            <div class="dashboard-area box--shadow">
                                <div class="row g-4">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="dashboard-card hover-border1">
                                            <div class="header">
                                                <h5>@lang('labels.dashboard-bilancio')</h5>
                                            </div>
                                            <div class="body">
                                                <div class="counter-item">
                                                    <h2>{{ number_format($utente->bilancio, 2) }}€</h2>
                                                </div>
                                                <div class="icon">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="dashboard-card hover-border1">
                                            <div class="header">
                                                <h5>@lang('labels.dashboard-inserzioni')</h5>
                                            </div>
                                            <div class="body">
                                                <div class="counter-item">
                                                    <h2>{{ count($utente->inserzioni) }}</h2>
                                                </div>
                                                <div class="icon">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="dashboard-card hover-border1">
                                            <div class="header">
                                                <h5>@lang('labels.dashboard-ordinies')</h5>
                                            </div>
                                            <div class="body">
                                                <div class="counter-item">
                                                    <h2>{{ count($utente->offerte) }}</h2>
                                                </div>
                                                <div class="icon">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="dashboard-card hover-border1">
                                            <div class="header">
                                                <h5>@lang('labels.dashboard-ordinicomp')</h5>
                                            </div>
                                            <div class="body">
                                                <div class="counter-item">
                                                    <h2>{{ count($utente->offerte_aggiudicate) }}</h2>
                                                </div>
                                                <div class="icon">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <form action="{{ asset('https://www.sandbox.paypal.com/cgi-bin/webscr') }}" method="POST">
                                            <input type="hidden" name="business" value="sb-7jmod15372947@business.example.com">
                                            <input type="hidden" name="cmd" value="_xclick">
                                            <input type="hidden" name="amount" value="5000">
                                            <input type="hidden" name="currency_code" value="EUR">
                                            <input type="hidden" name="return" value="{{ asset('user/dashboard/updateBudget') }}">
                                            <button type="submit" class="eg-btn btn--primary header-btn">@lang('labels.dashboard-paypal')</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade
                            @if (isset($messaggio) && !empty($messaggio))
                                show active
                            @endif
                            " id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">
                            @if (isset($messaggio) && !empty($messaggio))
                                <h2 style="color:red">{{ $messaggio }}</h2>
                            @endif
                            <div class="dashboard-profile">
                                <div class="owner">
                                    <div class="image">
                                        <img alt="image" src="{{ asset($utente->img_profilo) }}" width="120px">
                                    </div>
                                    <div class="content">
                                        <h3>{{ ucwords($utente->cognome) }} {{ ucwords($utente->nome) }}</h3>
                                        <p class="para">{{ '@'.$utente->username }}</p>
                                    </div>
                                </div>
                                <div class="form-wrapper">
                                    <form action="#" method="POST" id="form_update">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-12 col-md-6">
                                                <div class="form-inner">
                                                    <label>@lang('labels.dashboard-nome') *</label>
                                                    <input type="text" name="nome" value="{{ $utente->nome }}" id="nome_update" placeholder="@lang('labels.dashboard-nome-placeholder')" required>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-12 col-md-6">
                                                <div class="form-inner">
                                                    <label>@lang('labels.dashboard-cognome') *</label>
                                                    <input type="text" name="cognome" value="{{ $utente->cognome }}" id="cognome_update" placeholder="@lang('labels.dashboard-cognome-placeholder')" required>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-12 col-md-6">
                                                <div class="form-inner">
                                                    <label>@lang('labels.dashboard-email')</label>
                                                    <input type="text" name="email" value="{{ $utente->email }}" id="email_update" placeholder="@lang('labels.dashboard-email-placeholder')" readonly required>
                                                </div>
                                                <span id="errore_email_update"></span>
                                            </div>
                                            <div class="col-xl-6 col-lg-12 col-md-6">
                                                <div class="form-inner">
                                                    <label>@lang('labels.dashboard-paese')</label>
                                                    <input type="text" name="paese" value="{{ $utente->paese }}" id="paese_update" placeholder="@lang('labels.dashboard-paese-placeholder')">
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-12 col-md-6">
                                                <div class="form-inner">
                                                    <label>@lang('labels.dashboard-indirizzo')</label>
                                                    <input type="text" name="indirizzo" value="{{ $utente->indirizzo }}" id="indirizzo_update" placeholder="@lang('labels.dashboard-indirizzo-placeholder')">
                                                </div>
                                            </div>
                                            <div class="col-12 mt-4 mb-2">
                                                <div class="form-inner">
                                                    <h4>@lang('labels.dashboard-aggiornapass')</h4>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-inner">
                                                    <label>@lang('labels.dashboard-passwordattuale')</label>
                                                    <input type="password" name="vecchia_password" id="old_password_update"
                                                        placeholder="@lang('labels.dashboard-passwordattuale-placeholder')" />
                                                    <i class="bi bi-eye-slash" id="togglePassword_update_1"></i>
                                                    <span id="errore_old_password_update"></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-inner">
                                                    <label>@lang('labels.dashboard-nuovapassword')</label>
                                                    <input type="password" name="nuova_password" id="new_password_update"
                                                        placeholder="@lang('labels.dashboard-nuovapassword-placeholder')" />
                                                    <i class="bi bi-eye-slash" id="togglePassword_update_2"></i>
                                                    <span id="errore_new_password_update"></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-inner mb-0">
                                                    <label>@lang('labels.dashboard-confermapassword')</label>
                                                    <input type="password" name="conferma_password" id="confirm_password_update"
                                                        placeholder="@lang('labels.dashboard-confermapassword-placeholder')" />
                                                    <i class="bi bi-eye-slash" id="togglePassword_update_3"></i>
                                                    <span id="errore_confirm_password_update"></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="button-group">
                                                    <button type="submit" class="eg-btn profile-btn">@lang('labels.dashboard-aggiornaprofilo')</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-order" role="tabpanel"
                            aria-labelledby="v-pills-order-tab">

                            <div class="table-title-area">
                                <h3>@lang('labels.dashboard-offertefatte')</h3>
                                <input type="text" class="form-control" placeholder="@lang('labels.dashboard-filtra')" id="myInput-1">
                            </div>

                            <div class="table-wrapper">
                                <table id="myTable-1" class="eg-table order-table table mb-0 table-sorter">
                                    <thead>
                                        <tr>
                                            <th>@lang('labels.dashboard-th-prodotto')</th>
                                            <th>@lang('labels.dashboard-th-immagine')</th>
                                            <th>@lang('labels.dashboard-th-id-offerta')</th>
                                            <th>@lang('labels.dashboard-th-offerta')</th>
                                            <th>@lang('labels.dashboard-th-offerta-alta')</th>
                                            <th>@lang('labels.dashboard-th-stato')</th>
                                            <th>@lang('labels.dashboard-th-dataes')</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable-1Body">
                                        @forelse($utente->offerte as $offerta)
                                        <tr>
                                            <td data-label="Prodotto"><a href="{{ url('/') }}/prodotti/dettaglio/{{ $offerta->prodotto->id }}">{{ $offerta->prodotto->titolo }}</a></td>
                                            <td data-label="Immagine"><img alt="image" src="{{ asset($offerta->prodotto->immagini[0]->percorso) }}"
                                                    class="img-fluid"></td>
                                            <td data-label="ID_Offerta">Bidding_{{ $offerta->id }}</td>
                                            <td data-label="Offerta">{{ number_format($offerta->prezzo, 2) }}</td>
                                            <td data-label="Offerta più alta">{{ number_format($offerta->prodotto->offerta_alta(), 2) }}</td>
                                            <td data-label="Stato" 
                                                @if ($offerta->stato == "aggiudicato" || $offerta->stato == "piu_alta")
                                                    class="text-green"
                                                @else
                                                    class="text-red"
                                                @endif
                                            >{{ $offerta->stato }}</td>
                                            <td data-label="Data Esecuzione">{{ date(('d/m/Y H:i:s'), strtotime($offerta->data_esecuzione)) }}</td>
                                        </tr>
                                        @empty
                                            <h2 class="text-warning ml-4 p-4">@lang('labels.dashboard-nessunaofferta')</h2>
                                        @endforelse
                                        
                                    </tbody>
                                </table>
                            </div>

                            
                        </div>
                        <div class="tab-pane fade" id="v-pills-purchase" role="tabpanel"
                            aria-labelledby="v-pills-purchase-tab">

                            <div class="table-title-area">
                                <h3>@lang('labels.dashboard-tueinserzioni')</h3>
                                <input type="text" class="form-control" placeholder="@lang('labels.dashboard-filtra')" id="myInput-2">
                            </div>

                            <div class="table-wrapper">
                                <table class="eg-table order-table table mb-0" id="myTable-2">
                                    <thead>
                                        <tr>
                                            <th>@lang('labels.dashboard-th-id-prodotto')</th>
                                            <th>@lang('labels.dashboard-th-titolo')</th>
                                            <th>@lang('labels.dashboard-th-immagine')</th>
                                            <th>@lang('labels.dashboard-th-baseasta')</th>
                                            <th>@lang('labels.dashboard-th-offerta-alta')</th>
                                            <th>@lang('labels.dashboard-th-datascadenza')</th>
                                            <th>@lang('labels.dashboard-th-stato')</th>
                                            <th>Elimina</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable-2Body">
                                        @forelse($utente->inserzioni as $inserzione)
                                            <tr>
                                                <td data-label="ID_Prodotto">{{ $inserzione->id }}</td>
                                                <td data-label="Titolo">{{ $inserzione->titolo }}</td>
                                                <td data-label="Image"><img alt="image" src="{{ asset($inserzione->immagini[0]->percorso) }}"
                                                    class="img-fluid"></td>
                                                <td data-label="Base d'asta">{{ number_format($inserzione->base_asta, 2) }}</td>
                                                <td data-label="Offerta più alta">{{ number_format($inserzione->offerta_alta(), 2) }}</td>
                                                <td data-label="Data Scadenza">{{ $inserzione->data_scadenza }}</td>
                                                <td data-label="Stato">
                                                    @if (count($inserzione->offerte) == 0)
                                                        @lang('labels.dashboard-noofferta')
                                                    @else
                                                        @if ($inserzione->scaduto())
                                                            @lang('labels.dashboard-aggiudicato')
                                                        @else
                                                            @lang('labels.dashboard-astaincorso')
                                                        @endif
                                                    @endif
                                                </td>
                                                <td data-label="Elimina" class="text-red">
                                                    @if ($inserzione->cancellabile())
                                                    <form action="/prodotti/dettaglio/{{ $inserzione->id }}/delete" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button onclick="if (!confirm('Sei sicuro?')) { return false }">Elimina</button>
                                                    </form>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <h2 class="text-warning p-4 ml-4">@lang('labels.dashboard-noinserzioni')</h2>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection