@extends('layouts.app')

@section('title', 'F.A.Q.')



@section('content')

<div class="container container-transparent p-5 rounded-3 shadow">
    <div class="container py-5">
        <div class="row row-gap-3 justify-content-around align-items-end g-2">
            <div class="col-10 col-md-6">
                <img src="{{Vite::asset('resources/img/logo.png')}}" alt="">
            </div>
            <div class="col-10 col-md-6">
                <h1 class="display-5 fw-bold text-blue">
                    Benvenuto nel F.A.Q. di Fooder business!
                </h1>
                <img src="{{Vite::asset('resources/img/faq.png')}}" alt="">
            </div>
            <div class="accordion accordion-flush" id="accordionFlushFaq">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Posso eliminare le mie compagnie o i miei piatti?
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushFaq">
                        <div class="accordion-body">
                            Fooder Business offre la possibilità di eliminare temporaneamente i piatti e le compagnie. Potrai sempre ripristinare, sia piatti, sia compagnie eliminate dal cestino, nelle rispettive pagine.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Come funzionano le statistiche? 
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse"
                        data-bs-parent="#accordionFlushFaq">
                        <div class="accordion-body">
                            Nelle Statistiche avrai a disposizione due sezioni di grafici: <br>
                            Nella prima troverai dei grafici a torta tramite i quali confrontare le tue compagnia, 
                            sia per quanto riguarda le enntrate annuali, sia per quanto riguarda gli ordini ricevuti nel corso dell'anno corrente. <br>
                            Nella seconda sezione troverai un grafico a barre che ti permetterà di controllare le statistiche di ogni ristorante, uno alla volta.
                            Potrai controllare i suoi incassi ed i suoi ordini ricevuti da una data di partenza fino ad una data a tua scelta. Mostrerà i dati tabulati
                            giorno per giorno, nel caso l'intervallo sia inferiore ad un mese, mese per mese nel caso fosse superiore ad un mese ma inferiore ad un anno, 
                            ed infine anno per anno, nel caso l'intervallo da te selezionato fosse superiore ad un anno.

                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            Un piatto "Non Disponibile", verrà visualizzato nel mio Menù su Fooder?
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushFaq">
                        <div class="accordion-body">
                            Sì. Un piatto "Non Disponibile", verrà comunque visualizzato nel tuo Menù. Tuttavia un cliente non potrà aggiungerlo al carrello. 
                            Nel caso tu volessi nasconderlo dal menù, potrai eliminarlo temporaneamente premendo sull'icona del cestino. Potrai sempre ripristinarlo
                            in un secondo momento.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                            Posso controllare come un potenziale cliente visualizza il menù del mio ristorante su Fodder?
                        </button>
                    </h2>
                    <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushFaq">
                        <div class="accordion-body">
                            Certamente. Dalla pagina del tuo ristorante, puoi premere sul link "Vai al tuo menù su Fooder" e verrai portato direttamente sul tuo Menù con la prospettiva che ha un potenziale cilente.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection