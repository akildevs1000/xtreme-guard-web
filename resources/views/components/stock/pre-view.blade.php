@props(['record'])

<div class="row justify-content-center">
    <div class="col-5">
        <div class="card border" style="border-color: #c3c8cd !important;">
            <div class="card-header py-2" style="border-bottom: 1px solid #c3c8cd">
                <span class="float-end">
                    Number of Stocks
                    <span class="badge bg-info align-middle fs-10">
                        {{ count($record->payload) }}
                    </span>
                </span>
                <h6 class="card-title mb-0">Payload </h6>
            </div>
            <div class="card-body" data-simplebar style="max-height: 500px;">
                <pre>{{ json_encode($record->payload, JSON_PRETTY_PRINT) }}</pre>

            </div>
        </div>
    </div>
    <div class="col-5">
        <div class="card border" style="border-color: #c3c8cd !important;">
            <div class="card-header py-2" style="border-bottom: 1px solid #c3c8cd">
                <span class="float-end">
                    Number of Response
                    <span class="badge bg-info align-middle fs-10">
                        {{ count($record->response) }}
                    </span>
                </span>
                <h6 class="card-title mb-0"> Response </h6>
            </div>
            <div class="card-body" data-simplebar style="max-height: 500px;">
                <pre>{{ json_encode($record->payload, JSON_PRETTY_PRINT) }}</pre>
            </div>
        </div>
    </div>
</div>
