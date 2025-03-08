@extends('layout.app-site')

@section('content')
    <!-- map -->
    <div class="wrap-map">
        {{-- <div id="map-contact" class="map-contact h520" data-map-zoom="16" data-map-scroll="true"></div> --}}


        <iframe style="width:100%" height="550" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas"
            src="https://maps.google.com/maps?width=1048&amp;height=384&amp;hl=en&amp;q=%20Akil%20Security%20&amp;%20Alarm%20System%20Dubai%20LLC%20Dubai+(%20Akil%20Security%20&amp;%20Alarm%20System%20Dubai%20LLC)&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
        <a href='https://www.acadoo.de/leistungen/ghostwriter-masterarbeit/'>Masterarbeit Hilfe</a>
        <script type='text/javascript'
            src='https://embedmaps.com/google-maps-authorization/script.js?id=0d192e0e3316d832b0a8c41c943e9fc754d62650'>
        </script>

    </div>
    <!-- /map -->

    <!-- contact-us -->
    <section class="flat-spacing">
        <div class="container">
            <div class="contact-us-content">
                <div class="left">
                    <h4>Get In Touch</h4>
                    <p class="text-secondary-2">Use the form below to get in touch with the sales team</p>
                    <form id="contact-form" action="{{ url('admin/contacts') }}" method="post" class="form-leave-comment">
                        @csrf


                        {{-- 'name',
                        'email',
                        'phone',
                        'subject',
                        'message',
                        'company',
                        'country' --}}

                        <div class="wrap">
                            <div class="cols">
                                <fieldset class="">
                                    <input class="" type="text" placeholder="Your Name*" name="name"
                                        id="name" tabindex="2" value="" aria-required="true" required="">
                                </fieldset>
                                <fieldset class="">
                                    <input class="" type="text" placeholder="Your Company*" name="company"
                                        id="company" tabindex="2" value="" aria-required="true" required="">
                                </fieldset>
                            </div>

                            <div class="cols">
                                <fieldset class="">
                                    <input class="" type="text" placeholder="Your Phone*" name="phone"
                                        id="phone" tabindex="2" value="" aria-required="true" required="">
                                </fieldset>
                                <fieldset class="">
                                    <input class="" type="text" placeholder="Your Email*" name="email"
                                        id="email" tabindex="2" value="" aria-required="true" required="">
                                </fieldset>
                            </div>

                            <fieldset class="">
                                <textarea name="message" id="message" rows="4" placeholder="Your Message*" tabindex="2" aria-required="true"
                                    required=""></textarea>
                            </fieldset>
                        </div>
                        <div class="button-submit send-wrap">

                            <button class="tf-btn btn-fill" type="submit">
                                <span class="text text-button">Send message</span>
                            </button>

                            {{-- <button class="tf-btn btn-fill " type="button" id="sbtBtn" onclick="store()"> --}}

                            <button class="tf-btns btn-fill load-btn loadings" id="btnLoader" onclick="showLoader()">

                                {{-- <span class="text text-button">Send message</span> --}}

                                <span class="text text-button">
                                    <span>Submit</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 50">
                                        <circle fill="white" stroke="white" stroke-width="2" r="10" cx="20"
                                            cy="20">
                                            <animate attributeName="cy" calcMode="spline" dur="2s" values="20;40;20;"
                                                keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.4">
                                            </animate>
                                        </circle>
                                        <circle fill="white" stroke="white" stroke-width="2" r="10" cx="50"
                                            cy="20">
                                            <animate attributeName="cy" calcMode="spline" dur="2s" values="20;40;20;"
                                                keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.2">
                                            </animate>
                                        </circle>
                                        <circle fill="white" stroke="white" stroke-width="2" r="10" cx="80"
                                            cy="20">
                                            <animate attributeName="cy" calcMode="spline" dur="2s"
                                                values="20;40;20;" keySplines=".5 0 .5 1;.5 0 .5 1"
                                                repeatCount="indefinite" begin="0">
                                            </animate>
                                        </circle>
                                    </svg>

                                </span>

                            </button>

                            <button id="loadMoreGridBtn" class="load-more-btn btn-out-line tf-loading">
                                <span class="text-btn">Load more</span></button>

                            <button class="tf-btns btn-fill load-btn" id="btnLoader">
                                <span class="text text-button">
                                    <span>Submit</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 50">
                                        <circle fill="white" stroke="white" stroke-width="2" r="10" cx="20"
                                            cy="20">
                                            <animate attributeName="cy" calcMode="spline" dur="2s"
                                                values="20;40;20;" keySplines=".5 0 .5 1;.5 0 .5 1"
                                                repeatCount="indefinite" begin="-.4">
                                            </animate>
                                        </circle>
                                        <circle fill="white" stroke="white" stroke-width="2" r="10" cx="50"
                                            cy="20">
                                            <animate attributeName="cy" calcMode="spline" dur="2s"
                                                values="20;40;20;" keySplines=".5 0 .5 1;.5 0 .5 1"
                                                repeatCount="indefinite" begin="-.2">
                                            </animate>
                                        </circle>
                                        <circle fill="white" stroke="white" stroke-width="2" r="10" cx="80"
                                            cy="20">
                                            <animate attributeName="cy" calcMode="spline" dur="2s"
                                                values="20;40;20;" keySplines=".5 0 .5 1;.5 0 .5 1"
                                                repeatCount="indefinite" begin="0">
                                            </animate>
                                        </circle>
                                    </svg>
                                </span>
                            </button>

                        </div>
                    </form>
                </div>
                <div class="right">
                    <h4>Information</h4>
                    <div class="mb_20">
                        <div class="text-title mb_8">Phone:</div>
                        <p class="text-secondary">+1 666 234 8888</p>
                    </div>
                    <div class="mb_20">
                        <div class="text-title mb_8">Email:</div>
                        <p class="text-secondary">themesflat@gmail.com</p>
                    </div>
                    <div class="mb_20">
                        <div class="text-title mb_8">Address:</div>
                        <p class="text-secondary">2163 Phillips Gap Rd, West Jefferson, North Carolina, United States</p>
                    </div>
                    <div>
                        <div class="text-title mb_8">Open Time:</div>
                        <p class="mb_4 open-time">
                            <span class="text-secondary">Mon - Sat:</span> 7:30am - 8:00pm PST
                        </p>
                        <p class="open-time">
                            <span class="text-secondary">Sunday:</span> 9:00am - 5:00pm PST
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <button class="btn loading" id="btnLoader" onclick="showLoader()">
            <span class="btn-text">Submit</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 50">
                <circle fill="white" stroke="white" stroke-width="2" r="10" cx="20" cy="20">
                    <animate attributeName="cy" calcMode="spline" dur="2s" values="20;40;20;"
                        keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.4">
                    </animate>
                </circle>
                <circle fill="white" stroke="white" stroke-width="2" r="10" cx="50" cy="20">
                    <animate attributeName="cy" calcMode="spline" dur="2s" values="20;40;20;"
                        keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="-.2">
                    </animate>
                </circle>
                <circle fill="white" stroke="white" stroke-width="2" r="10" cx="80" cy="20">
                    <animate attributeName="cy" calcMode="spline" dur="2s" values="20;40;20;"
                        keySplines=".5 0 .5 1;.5 0 .5 1" repeatCount="indefinite" begin="0">
                    </animate>
                </circle>
            </svg>
        </button>

    </section>
    <!-- /contact-us -->
    @push('scripts')
        <script src="{{ asset('assets/js/ajax.js') }}"></script>
        <script src="{{ asset('assets/js/custom-table.js') }}"></script>
        <script src="{{ asset('assets/js/helper.js') }}"></script>

        <script>
            // function showLoader() {
            //     let btn = document.getElementById("btnLoader");
            //     btn.classList.add("loading");

            //     // Select the span containing the "Submit" text
            //     let textSpan = btn.querySelector(".text.text-button > span");
            //     if (textSpan) {
            //         textSpan.classList.add("d-none"); // Hide the text
            //     }

            //     // Simulate a delay (e.g., waiting for an API response)
            //     setTimeout(() => {
            //         btn.classList.remove("loading");

            //         textSpan.classList.remove("d-none"); // Hide the text
            //     }, 3000); // 3 seconds
            // }

            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".load-btn").forEach(function(btn) {
                    btn.addEventListener("click", function() {
                        btn.classList.add("loading");

                        // Select the span containing the "Submit" text
                        let textSpan = btn.querySelector(".text.text-button > span");
                        if (textSpan) {
                            textSpan.classList.add("d-none"); // Hide the text
                        }
                    });
                });
            });



            const formName = 'contact-form'

            function store() {
                // sLoadingSite('sbtBtn')
                return;

                console.log(formName);

                var form = document.getElementById(formName);
                var url = form.getAttribute('action');
                var method = form.getAttribute('method');
                var payload = new FormData(form);

                console.log(payload);

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
                            // $("#contact-form :input").not("#is_active").val("");
                            alertNotify(response.message, 'success')
                            associateErrors([], 'contact-form');
                            eLoading('sbtBtn')
                        } else {
                            associateErrors(response.errors, 'contact-form');
                            eLoading('sbtBtn')
                        }
                    },
                    (error) => {
                        console.error('Error:', error);
                    }
                );
            }
        </script>
    @endpush

    <style>
        .load-btn svg {
            width: 30px;
            height: 30px;
            display: none;
        }

        .loading svg {
            display: inline-block;
        }
    </style>
@endsection
