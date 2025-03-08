 @props(['order'])

 @php
     $orderIsPickuped = $order->is_pickuped;
 @endphp


 <div id="flipModal" class="modal fade" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true"
     style="display: none;">


     <div class="modal-dialog modal-dialog-centered" style="max-width: 620px;">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalgridLabel">Return Order</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">

                 <div class="error-container" style="display:none; font-family: system-ui; ">
                     {{-- <div class="alert alert-danger py-0 pt-1"> --}}
                     <div
                         class="alert alert-danger alert-dismissible alert-label-icon label-arrow fade show mb-xl-0 py-0 pt-1">
                         <i class="ri-error-warning-line label-icon"></i>
                         <strong class="ms-5">There were some problems with your input:</strong>
                         <ul class="error-list ms-2"></ul>
                     </div>
                 </div>

                 {{-- <form action="javascript:void(0);"> --}}
                 <form action="{{ url('order/return-order', ['orderid' => $order->order_id]) }}" id="return-form"
                     method="POST" class="tablelist-form" autocomplete="off">
                     @csrf
                     <div class="row g-3 mt-2">
                         <div class="col-xxl-12">

                             {{-- <x-input.txt-group label="Last Name" name="customer_city"
                                 placeholder="Enter your last name" /> --}}

                             <div class="form-group">
                                 <label for="lastName" class="form-label"> Pickup City
                                     <i class="text-danger">*</i>
                                 </label>
                                 <select class="form-select" name="customer_city" id="customer_city" data-choices>
                                     <option value="" selected>select</option>
                                     @foreach (config('cpanel.aramexValidCities') as $city)
                                         <option value="{{ $city }}">{{ $city }}</option>
                                     @endforeach
                                 </select>
                                 <div class="invalid-feedback d-block invalid-msg"> </div>

                             </div>
                         </div>
                         <div class="col-xxl-12">
                             <div class="form-group">
                                 <div class="form-check form-switch form-check-right">
                                     Pickup Date & Time
                                     <input class="form-check-input" type="checkbox" role="switch" id="enablePickup"
                                         value="1" onchange="togglePickupDate()" name="is_enable_pickup_date">
                                 </div>

                                 <input type="text" class="form-control" data-provider="flatpickr"
                                     data-date-format="d M, Y" data-default-date="{{ setDefultDateForReturn() ?? '' }}"
                                     data-enable-time name="pickupDate" id="pickupDate" disabled name="pickup_date">
                                 <div class="invalid-feedback d-block invalid-msg"> </div>

                                 <small>
                                     <i class="text-muted">
                                         Note: By default, the date will be set to the next day. If you want to select a
                                         date manually, it should not be a Sunday, and the time should be between
                                         <b>08:00</b>
                                         AM and <b>06:00 PM</b>.</i>
                                 </small>
                             </div>
                         </div>
                         <div class="col-lg-12">
                             <div class="form-group">
                                 <label class="form-label">Customer Mobile</label>
                                 <div class="input-group" data-input-flag>
                                     <button class="btn btn-light border" type="button" data-bs-toggle="dropdown"
                                         aria-expanded="false">
                                         <img src="https://themesbrand.com/velzon/html/default/assets/images/flags/ae.svg"
                                             alt="flag img" height="20" class="country-flagimg rounded">
                                         <span class="ms-2 country-codeno">+ 971</span>
                                     </button>
                                     @php
                                         //order->shipping->address['telephone']
                                         $isHas = hasCountryCode($order->customer->phone);
                                         $contact = $isHas
                                             ? removeCountryCode($order->customer->phone)
                                             : $order->customer->phone;
                                     @endphp
                                     <input type="text" class="form-control rounded-end flag-input"
                                         placeholder="Enter number" value="{{ $contact }}" name="customer_mobile">
                                     <div class="invalid-feedback d-block invalid-msg"> </div>
                                 </div>
                                 <small>
                                     <i class="text-muted">
                                         Note: By default phone no is <b>{{ $order->customer->phone }}</b>, you can
                                         change the
                                         mobile number if needed.
                                     </i>
                                 </small>
                             </div>
                         </div>

                         <div class="col-lg-12">
                             <div class="hstack gap-2 justify-content-end">
                                 <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                 {{-- <button type="button" class="btn btn-primary" onclick="submitForm()">Submit</button> --}}

                                 <button type="button" onclick="store()" id="sbtBtn"
                                     class="btn btn-primary {{ $orderIsPickuped ? 'disabled' : '' }}">
                                     {{ $orderIsPickuped ? 'Already requested' : 'Submit' }}
                                 </button>

                             </div>
                         </div>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>

 @push('scripts')
     <script>
         //  function store() {
         //      let pickupCity = $('[data-choices]').val();
         //      let pickupDate = $('#pickupDate').val();
         //      let customerMobile = $('[data-input-flag] input').val();

         //      console.log(pickupCity, pickupDate, customerMobile);
         //  }

         function store() {
             sLoading('sbtBtn')
             var form = document.getElementById('return-form');
             var url = form.getAttribute('action');
             var method = form.getAttribute('method');
             var payload = new FormData(form);

             const options = {
                 // contentType: 'application/json',
                 contentType: 'multipart/form-data',
                 method: 'POST',
                 headers: {
                     dataType: "json",
                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                 }
             };

             sendData(
                 url,
                 payload,
                 options,
                 (response) => {
                     console.log('Success:', response.status);
                     if (response.status) {
                         $("#return-form :input").not("#is_active").val("");
                         alertNotify(response.message, 'success')
                         associateErrors([], 'return-form');
                         eLoading('sbtBtn')
                         window.location.reload();
                     } else {

                         if (response.isAramexError) {
                             showErrorMsg(response)
                             //  eLoading('sbtBtn')
                         }

                         associateErrors(response.errors, 'return-form');
                         eLoading('sbtBtn')
                     }
                 },
                 (error) => {
                     console.error('Error:', error);
                 }
             );

             //  eLoading('sbtBtn')

         }

         function togglePickupDate() {
             let isChecked = $("#enablePickup").is(":checked");
             $("#pickupDate").prop("disabled", !isChecked).prop("readonly", !isChecked);
         }

         function showErrorMsg(response) {
             // Clear previous errors
             $('.error-list').empty();

             // Loop through the errors and display them
             $.each(response.errors, function(key, messages) {


                 let formattedKey = key.replace(/\.0$/, '');
                 formattedKey = formattedKey.replace('.', ' '); // Optional: Replace '.' with space

                 console.log('formattedKey', formattedKey);

                 let errorHtml = `<li><strong>${formattedKey}:</strong><ul>`;
                 errorHtml += `<li>${messages}</li>`

                 errorHtml += '</ul></li>';

                 console.log('errorHtml', errorHtml);

                 $('.error-list').append(errorHtml);
             });

             $('.error-container').show();
         }
     </script>
 @endpush

 @php
     //  function setDefultDate()
     //  {
     //      $today = now();
     //      $endOfMonth = now()->endOfMonth();

     //      return $today->format('d M, Y') . ' to ' . $endOfMonth->format('d M, Y');
     //  }
 @endphp

 <style>
     .choices {
         margin-bottom: 0px !important;
     }

     .choices__list--dropdown {
         z-index: 9999 !important;
     }

     .error-container {
         margin-top: 20px;
     }

     .alert-danger {
         /* border: 1px solid #dc3545; */
         /* background-color: #f8d7da; */
         /* color: #721c24; */
         padding: 15px;
     }

     .error-list li {
         margin: 5px 0;
     }
 </style>
