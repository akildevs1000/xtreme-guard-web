<?php $__env->startSection('content'); ?>
    <?php
        $contactInfo = [
            ['title' => 'Phone', 'value' => '+971 52 482 0440'],
            ['title' => 'Email', 'value' => 'sales@akilsecurity.com'],
            ['title' => 'Address', 'value' => '26 Al Nahdha St - Bur dubai - Al Fahidi - Dubai'],
        ];

        $openTime = [
            ['day' => 'Mon - Sat', 'time' => '9:30am - 9:30pm'],
            ['day' => 'Sunday', 'time' => '9:00am - 5:00pm'],
        ];
    ?>

    <!-- map -->
    <div class="wrap-map">
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
                    <form id="contact-form" action="<?php echo e(url('contact')); ?>" method="post" class="form-leave-comment">
                        <?php echo csrf_field(); ?>
                        <div class="wrap">
                            <div class="cols">
                                <fieldset class="">
                                    <input class="frm" type="text" placeholder="Your Name*" name="name"
                                        id="name" tabindex="2" value="" aria-required="true" required="">
                                    <div class="invalid-feedback d-block invalid-msg"> </div>
                                </fieldset>
                                <fieldset class="">
                                    <input class="frm" type="text" placeholder="Your Company" name="company"
                                        id="company" tabindex="2" value="" aria-required="true" required="">
                                    <div class="invalid-feedback d-block invalid-msg"> </div>
                                </fieldset>
                            </div>

                            <div class="cols">
                                <fieldset class="">
                                    <input class="frm" type="text" placeholder="Your Phone" name="phone"
                                        id="phone" tabindex="2" value="" aria-required="true" required="">
                                    <div class="invalid-feedback d-block invalid-msg"> </div>
                                </fieldset>
                                <fieldset class="">
                                    <input class="frm" type="text" placeholder="Your Email*" name="email"
                                        id="email" tabindex="2" value="" aria-required="true" required="">
                                    <div class="invalid-feedback d-block invalid-msg"> </div>
                                </fieldset>
                            </div>

                            <div class="cols">
                                <fieldset class="">
                                    <input class="frm" type="text" placeholder="Enter subject*" name="subject"
                                        id="subject" tabindex="2" value="" aria-required="true" required="">
                                    <div class="invalid-feedback d-block invalid-msg"> </div>
                                </fieldset>
                            </div>

                            <fieldset class="">
                                <textarea class="frm" name="message" id="message" rows="4" placeholder="Your Message*" tabindex="2"
                                    aria-required="true" required=""></textarea>
                                <div class="invalid-feedback d-block invalid-msg"> </div>
                            </fieldset>
                        </div>
                        <div class="button-submit send-wrap">

                            <button class="tf-btns btn-fill load-btn loadings" type="button" id="btnLoader"
                                onclick="store()">
                                <span class="text text-button">
                                    <span>Send message</span>
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

                    <?php $__currentLoopData = $contactInfo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="mb_20">
                            <div class="text-title mb_8"><?php echo e($info['title']); ?>:</div>
                            <p class="text-secondary"><?php echo e($info['value']); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <div>
                        <div class="text-title mb_8">Open Time:</div>
                        <?php $__currentLoopData = $openTime; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p class="open-time">
                                <span class="text-secondary"><?php echo e($time['day']); ?>:</span> <?php echo e($time['time']); ?>

                            </p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <!-- /contact-us -->
    <?php $__env->startPush('scripts'); ?>
        <script src="<?php echo e(asset('assets/js/ajax.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/custom-table.js')); ?>"></script>
        <script src="<?php echo e(asset('assets/js/helper.js')); ?>"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".load-btn").forEach(function(btn) {
                    btn.addEventListener("click", function() {
                        btn.classList.add("loading");

                        // Select the span containing the "Submit" text
                        let textSpan = btn.querySelector(".text.text-button > span");
                        if (textSpan) {
                            textSpan.classList.add("d-none"); // Hide the text
                        }

                        // setTimeout(() => {
                        //     btn.classList.remove("loading");
                        //     textSpan.classList.remove("d-none"); // Hide the text
                        // }, 3000); // 3 seconds
                    });
                });
            });

            function eLoadingSite(btnId = 'sbtBtn') {
                let btn = document.querySelector(`#${btnId}`);

                if (btn) {
                    setTimeout(() => {
                        btn.classList.remove("loading");
                        let textSpan = btn.querySelector(".text.text-button > span");
                        if (typeof textSpan !== 'undefined') {
                            textSpan.classList.remove("d-none");
                        }
                    }, 500);
                } else {
                    console.error('Button not found.');
                }
            }


            const formName = 'contact-form'

            function store() {
                // sLoadingSite('sbtBtn')
                // return;

                var form = document.getElementById(formName);
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
                        // console.log('Success:', response);
                        if (response.status) {
                            // $("#contact-form :input").not("#is_active").val("");
                            alertNotify(response.message, 'success')
                            associateErrors1([], 'contact-form');
                            eLoadingSite('btnLoader')
                        } else {
                            associateErrors1(response.errors, 'contact-form');

                            eLoadingSite('btnLoader')


                            // eLoading('sbtBtn')
                        }
                    },
                    (error) => {
                        console.error('Error:', error);
                    }
                );
            }

            function associateErrors1(errors, formId) {
                let $form = $(`#${formId}`);
                $form.find('fieldset .invalid-msg').text('');
                $form.find('fieldset .frm').removeClass('is-invalid');

                Object.keys(errors).forEach(function(fieldName) {

                    let $group = $form.find('[name="' + fieldName + '"]');
                    $group.addClass('is-invalid');
                    $group.closest('fieldset').find('.invalid-msg').text(errors[fieldName][0]);
                });
            }

            function alertNotify(msg, status) {

                let sts = status || 'success';

                const arr = {
                    success: 'bg-success',
                    error: 'bg-danger',
                    warning: 'bg-info',
                }
                console.log(arr[sts]);
                Toastify({
                    text: msg || '',
                    duration: 3000,
                    newWindow: true,
                    close: false,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    className: arr[sts],
                    // style: {
                    //     background: "linear-gradient(to right, #00b09b, #96c93d)",
                    // },
                    onClick: function() {} // Callback after click
                }).showToast();
            }
        </script>
    <?php $__env->stopPush(); ?>

    <style>
        .load-btn svg {
            width: 30px;
            height: 30px;
            display: none;
        }

        .load-btn:hover {
            background: black;
            color: white;
        }

        .loading svg {
            display: inline-block;
        }



        .toast:not(:last-child) {
            margin-bottom: .75rem
        }

        .toast-border-primary .toast-body {
            color: #405189;
            border-bottom: 3px solid #405189
        }

        .toast-border-secondary .toast-body {
            color: #3577f1;
            border-bottom: 3px solid #3577f1
        }

        .toast-border-success .toast-body {
            color: #0ab39c;
            border-bottom: 3px solid #0ab39c
        }

        .toast-border-info .toast-body {
            color: #299cdb;
            border-bottom: 3px solid #299cdb
        }

        .toast-border-warning .toast-body {
            color: #f7b84b;
            border-bottom: 3px solid #f7b84b
        }

        .toast-border-danger .toast-body {
            color: #f06548;
            border-bottom: 3px solid #f06548
        }

        .toast-border-light .toast-body {
            color: #f3f6f9;
            border-bottom: 3px solid #f3f6f9
        }

        .toast-border-dark .toast-body {
            color: #212529;
            border-bottom: 3px solid #212529
        }


        .toastify {
            padding: 12px 16px;
            color: #fff;
            display: inline-block;
            -webkit-box-shadow: 0 3px 6px -1px rgba(0, 0, 0, .12), 0 10px 36px -4px rgba(77, 96, 232, .3);
            box-shadow: 0 3px 6px -1px rgba(0, 0, 0, .12), 0 10px 36px -4px rgba(77, 96, 232, .3);
            background: var(--vz-success);
            position: fixed;
            opacity: 0;
            -webkit-transition: all .4s cubic-bezier(.215, .61, .355, 1);
            transition: all .4s cubic-bezier(.215, .61, .355, 1);
            border-radius: 2px;
            cursor: pointer;
            text-decoration: none;
            max-width: calc(50% - 20px);
            z-index: 2147483647
        }

        .toastify.on {
            opacity: 1
        }

        .toast-close {
            opacity: .4;
            padding: 0 5px;
            position: relative;
            left: 4px;
            margin-left: 4px;
            border: none;
            background: 0 0;
            color: #fff
        }

        .toastify-right {
            right: 15px
        }

        .toastify-left {
            left: 15px
        }

        .toastify-left .toast-close {
            left: -4px;
            margin-left: 0;
            margin-right: 4px
        }

        .toastify-top {
            top: -150px
        }

        .toastify-bottom {
            bottom: -150px
        }

        .toastify-rounded {
            border-radius: 25px
        }

        .toastify-avatar {
            width: 1.5em;
            height: 1.5em;
            margin: -7px 5px;
            border-radius: 2px
        }

        .toastify-center {
            margin-left: auto;
            margin-right: auto;
            left: 0;
            right: 0;
            max-width: -webkit-fit-content;
            max-width: fit-content;
            max-width: -moz-fit-content
        }

        @media only screen and (max-width:360px) {

            .toastify-left,
            .toastify-right {
                margin-left: auto;
                margin-right: auto;
                left: 0;
                right: 0;
                max-width: -webkit-fit-content;
                max-width: -moz-fit-content;
                max-width: fit-content
            }
        }


        .toast {
            --vz-toast-zindex: 1090;
            --vz-toast-padding-x: 0.75rem;
            --vz-toast-padding-y: 0.5rem;
            --vz-toast-spacing: 1.5rem;
            --vz-toast-max-width: 350px;
            --vz-toast-font-size: 0.875rem;
            --vz-toast-bg: var(--vz-secondary-bg);
            --vz-toast-border-width: var(--vz-border-width);
            --vz-toast-border-color: var(--vz-border-color);
            --vz-toast-border-radius: var(--vz-border-radius);
            --vz-toast-box-shadow: var(--vz-box-shadow);
            --vz-toast-header-color: var(--vz-secondary-color);
            --vz-toast-header-bg: var(--vz-secondary-bg);
            --vz-toast-header-border-color: var(--vz-border-color);
            width: var(--vz-toast-max-width);
            max-width: 100%;
            font-size: var(--vz-toast-font-size);
            color: var(--vz-toast-color);
            pointer-events: auto;
            background-color: var(--vz-toast-bg);
            background-clip: padding-box;
            border: var(--vz-toast-border-width) solid var(--vz-toast-border-color);
            -webkit-box-shadow: var(--vz-toast-box-shadow);
            box-shadow: var(--vz-toast-box-shadow);
            border-radius: var(--vz-toast-border-radius)
        }

        .toast.showing {
            opacity: 0
        }

        .toast:not(.show) {
            display: none
        }

        .toast-container {
            --vz-toast-zindex: 1090;
            position: absolute;
            z-index: var(--vz-toast-zindex);
            width: -webkit-max-content;
            width: -moz-max-content;
            width: max-content;
            max-width: 100%;
            pointer-events: none
        }

        .toast-container>:not(:last-child) {
            margin-bottom: var(--vz-toast-spacing)
        }

        .toast-header {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            padding: var(--vz-toast-padding-y) var(--vz-toast-padding-x);
            color: var(--vz-toast-header-color);
            background-color: var(--vz-toast-header-bg);
            background-clip: padding-box;
            border-bottom: var(--vz-toast-border-width) solid var(--vz-toast-header-border-color);
            border-top-left-radius: calc(var(--vz-toast-border-radius) - var(--vz-toast-border-width));
            border-top-right-radius: calc(var(--vz-toast-border-radius) - var(--vz-toast-border-width))
        }

        .toast-header .btn-close {
            margin-right: calc(-.5 * var(--vz-toast-padding-x));
            margin-left: var(--vz-toast-padding-x)
        }

        .toast-body {
            padding: var(--vz-toast-padding-x);
            word-wrap: break-word
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app-site', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Install\laragon\www\akil\resources\views/site/contact/index.blade.php ENDPATH**/ ?>