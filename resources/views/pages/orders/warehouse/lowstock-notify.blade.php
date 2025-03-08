<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LowStock</title>
    <link rel="shortcut icon" href="{{ getcwd() . '/public/assets/images/favicon.ico' }}" />
</head>

<body>

    <header>
        <div class="row dot mt-0" style="">
            <div class="col-4">
                @php
                    $imgUrl = getcwd() . '/public/assets/images/allogo.png';
                @endphp
                <img src="{{ $imgUrl }}" alt="logo" style="width:140px;">
            </div>
            <div class="col-3" stylse="background-color:red">
                <span>Daily Low Stock</span>
            </div>
        </div>

        <div class="row mt-3 dot sum-headerd">

            <div class="col-4">
                <p class="text-muted mb-1 text-uppercase fw-semibold">Company</p>
                <p class="fs-12 mt-1 mb-0"><b id="invoice-no">{{ 'Al Oufouk' }}</b></p>
            </div>
            <div class="col-4">
                <p class="text-muted mb-1 text-uppercase fw-semibold">Report Generate On</p>
                <p class="fs-12 mt-0 mb-0">
                    <b id="invoice-date">
                        {{ date('d M Y') }}
                    </b>
                </p>
            </div>
            <div class="col-4">
                <p class="text-muted mb-1 text-uppercase fw-semibold">Number of Stock</p>
                <p class="fs-12 mt-0 mb-0">
                    <b id="invoice-date" style="">
                        {{ count($lowStockData) ?? '' }}
                    </b>
                </p>
            </div>
        </div>
    </header>

    <footer>
        Page <span class="page-number"></span>
    </footer>

    <main styles="margin-bottom:20%">
        <div class="row">
            <div class="col-12" styles="margin-top: 5%">
                <table id="invoice-table" class="">
                    <thead>
                        <tr class="table-active">
                            <th style="width: 50px;">#</th>
                            <th>Product Details</th>
                            <th>Item Code</th>
                            <th>Quantity</th>
                            <th>Unit</th>
                            <th>Barcode</th>
                            <th>Item Type</th>
                            <th>UpdatedAt</th>
                        </tr>
                    </thead>
                    <tbody id="products-list">
                        @foreach ($lowStockData as $item)
                            <tr>
                                <td scope="row"><b>{{ $loop->iteration }}</b></td>
                                <td>{{ $item['item'] ?? '' }}</td>
                                <td>{{ $item['item_code'] }}</td>
                                <td>{{ $item['qty'] ?? '' }}</td>
                                <td>{{ $item['unit'] ?? '' }}</td>
                                <td>{{ $item['barcode'] ?? '' }}</td>
                                <td>{{ $item['item_type'] ?? '' }}</td>
                                <td>{{ date('Y-m-d', strtotime($item['updated_at'])) ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <label class="support-label">For consumer support, please visit
                    <a href="https://www.ploom.ae/en/help---support/contact-us" target="_blank"
                        class="link-secondary link-offset-2 text-decoration-underline link-underline-opacity-25 link-underline-opacity-100-hover">
                        Contact Us</a>
                </label>
            </div>
        </div>

    </main>
</body>

</html>


<style>
    @page {
        margin: 100px 25px;
        background-color: red;
        /* margin: 50px 25px 25px; */
    }

    .page-break {
        page-break-after: always;
    }

    header {
        /* position: fixed; */
        top: -100px;
        left: 0px;
        right: 0px;
        height: 50px;
        text-align: center;
        margin-top: -100px;
    }

    footer {
        position: fixed;
        bottom: -50px;
        left: 0px;
        right: 0px;
        height: 20px;
        text-align: right;
        /* background-color: rgb(236, 235, 235); */
        font-size: 12px;
        align-items: center
    }

    main {
        margin-top: 150px;
        /* Additional spacing if needed for content */
    }

    body {
        margin: 0;
        padding: 0;
        /* Adding padding to push content below the header */
        /* padding-top: 50px; */
        /* Height of the header */
        padding-bottom: 100px;
        /* Margin space you want at the bottom */
    }


    .page-number:after {
        content: counter(page);
    }

    .bg-info-subtle {
        background-color: #dff0fa !important;
    }

    .support-label {
        font-size: 11px;
        position: fixed;
        bottom: 0;
    }

    * {
        box-sizing: border-box;
    }

    .dot {
        border-bottom: 0.5px dashed #040404;
    }

    .dot-top {
        border-top: 0.5px dashed #040404;
    }

    #invoice-table tbody tr td {
        vertical-align: baseline
    }

    .fw-normal {
        font-weight: 400 !important;
    }

    .mb-0 {
        margin-bottom: 0px;
    }

    .mb-1 {
        margin-bottom: 0.25rem;
    }

    .mb-2 {
        margin-bottom: 0.50rem;
    }

    .mb-3 {
        margin-bottom: 0.75rem;
    }

    .mt-0 {
        margin-top: 0px;
    }

    .m-1 {
        margin-top: 0.25rem;
    }

    .m-2 {
        margin-top: 0.5rem;
    }

    .m-3 {
        margin-top: 1rem;
    }

    .mt-2 {
        margin-top: 0.5rem;
    }

    .mt-3 {
        margin-top: 1rem;
    }

    .mt-4 {
        margin-top: 1.50rem;
    }

    .mr-1 {
        margin-right: 0.25rem;
    }

    .ml-3 {
        margin-left: 1rem;
    }

    .mx-4 {
        margin-right: 1.5rem;
        margin-left: 1.5rem;
    }

    .my-5 {
        margin-top: 2.5rem;
        margin-bottom: 2.5rem;
    }

    .pr-1 {
        padding-right: 0.25rem;
    }

    .pt-2 {
        padding-top: 0.5rem;
    }

    .pl-3 {
        padding-left: 1rem;
    }

    .px-4 {
        padding-right: 1.5rem;
        padding-left: 1.5rem;
    }

    .py-5 {
        padding-top: 2.5rem;
        padding-bottom: 2.5rem;
    }

    .row::after {
        content: "";
        clear: both;
        display: table;
    }

    .col {
        width: 5%;
        float: left;
        padding: 5px;
    }


    .col-1 {
        width: 8.33%;
        float: left;
        padding: 5px;
    }

    .col-2 {
        width: 16.66%;
        float: left;
        padding: 5px;
    }

    .col-3 {
        width: 24.99%;
        float: left;
        padding: 5px;
    }

    .col-4 {
        width: 33.32%;
        float: left;
        padding: 5px;
    }

    .col-5 {
        width: 41.65%;
        float: left;
        padding: 5px;
    }

    .col-6 {
        width: 49.98%;
        float: left;
        padding: 5px;
    }

    .col-7 {
        width: 58.31%;
        float: left;
        padding: 5px;
    }

    .col-8 {
        width: 66.64%;
        float: left;
        padding: 5px;
    }

    .col-9 {
        width: 74.97%;
        float: left;
        padding: 5px;
    }

    .col-10 {
        width: 83.3%;
        float: left;
        padding: 5px;
    }

    .col-11 {
        width: 91.63%;
        float: left;
        padding: 5px;
    }

    .col-12 {
        width: 100%;
        float: left;
        padding: 5px;
    }

    .form-input {
        width: 100%;
        padding: 2px 5px;
        border-radius: 0px;
        resize: vertical;
        outline: 0;
    }

    .label-txt {
        font-size: 14px
    }

    ,
    input {
        /* border: none; */
        /* border-bottom: 1px solid black; */
        padding: 5px 10px;
        outline: none;
        font-size: 13px
    }

    hr {
        position: relative;
        border: none;
        height: 1px;
        background: rgb(167, 164, 164);
    }

    .terms {
        font-size: 12px;
        font-family: Arial, Helvetica, sans-serif
    }

    .header-txt {
        font-size: 20px;
        font-weight: bolder;
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
    }

    .header-txt-span {
        font-size: 12px;
        font-weight: bolder;
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        text-align: center;
    }

    .header-txt-address {
        font-size: 12px;
        font-weight: bolder;
        font-family: Arial, Helvetica, sans-serif;
        margin: 0px;
        padding: 0px;
    }

    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        border: 0px solid #e9e9e9;
        /* width: 50%; */
        margin: auto;
    }

    #invoice-table td,
    th {
        font-size: 10px;
        text-align: left;
        padding: 2px 2px;
        border-top: 1px solid #e9e9e9;
        border-bottom: 1px solid #e9e9e9;
    }

    .sum-table td,
    th {
        font-size: 10px;
        text-align: left;
        padding: 2px 2px;
        border-top: 1px solid #e9e9e9;
        border-bottom: 1px solid #e9e9e9;
    }



    /* ------------------------ */
    .justify-content-center {
        -webkit-box-pack: center !important;
        justify-content: center !important;
    }

    .text-center {
        text-align: center !important
    }

    .text-end {
        text-align: right !important
    }

    .text-start {
        text-align: left !important
    }


    .sum-table {
        text-align: right;
        /* Aligns the text in the div to the right */
    }

    .sum-table table {
        margin-left: auto;
        margin-right: 0;
    }

    .sum-header {
        margin-left: auto;
        margin-right: 0;
        text-align: center;
    }

    .fs-1 {
        font-size: 1px;
    }

    .fs-2 {
        font-size: 2px;
    }

    .fs-3 {
        font-size: 3px;
    }

    .fs-4 {
        font-size: 4px;
    }

    .fs-5 {
        font-size: 5px;
    }

    .fs-6 {
        font-size: 6px;
    }

    .fs-7 {
        font-size: 7px;
    }

    .fs-8 {
        font-size: 8px;
    }

    .fs-9 {
        font-size: 9px;
    }

    .fs-10 {
        font-size: 10px;
    }

    .fs-11 {
        font-size: 11px;
    }

    .fs-12 {
        font-size: 12px;
    }

    .fs-13 {
        font-size: 13px;
    }

    .fs-14 {
        font-size: 14px;
    }

    .fs-15 {
        font-size: 15px;
    }

    .fs-16 {
        font-size: 16px;
    }

    .fs-17 {
        font-size: 17px;
    }

    .fs-18 {
        font-size: 18px;
    }

    .fs-19 {
        font-size: 19px;
    }

    .fs-20 {
        font-size: 20px;
    }

    p {
        font-size: 12px;
        padding: 0px;
        margin: 0px;

        font-family: "Poppins", sans-serif;
    }

    body {
        font-family: "Poppins", sans-serif;
    }

    /* ------------------------ */
</style>
