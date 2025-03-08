//
import "https://code.jquery.com/jquery-3.6.0.min.js";
import "../assets/libs/bootstrap/js/bootstrap.bundle.min.js";
import "../assets/libs/simplebar/simplebar.min.js";
import "../assets/libs/feather-icons/feather.min.js";
// import "../assets/js/pages/plugins/lord-icon-2.1.0.js";
import "../assets/js/plugins.js";
// import "https://cdn.jsdelivr.net/npm/toastify-js";

import "../assets/libs/choices.js/public/assets/scripts/choices.min.js";
// import "../assets/js/choices.min.js";

import "../assets/libs/flatpickr/flatpickr.min.js";

//  <!-- external plugin -->

import "../assets/libs/prismjs/prism.js";
import "../assets/libs/apexcharts/apexcharts.min.js";

// <!-- Sweet Alerts js -->
import "../assets/libs/sweetalert2/sweetalert2.min.js";

//   apexcharts
import "../assets/libs/apexcharts/apexcharts.min.js";

//   Vector map
import "../assets/libs/jsvectormap/js/jsvectormap.min.js";
import "../assets/libs/jsvectormap/maps/world-merc.js";

//   Swiper slider js
import "../assets/libs/swiper/swiper-bundle.min.js";

// Toastify notification
import Toastify from 'toastify-js'

//   Dashboard init
import "../assets/js/pages/dashboard-ecommerce.init.js";
import "../assets/js/custom.js";

//  <!-- external plugin -->

import "../assets/js/app.js";
import "../assets/js/custom-table.js";

//  <!-- helper file -->
import * as helper from '../assets/js/helper.js';

const functionsToAssign = [

    // toastify.js
    'Toastify',

    //helper.js
    'convertToDateFormat',
    'validateField',
    'activeTab',
    'disableTab',
    'enableTab',
    'clearField',
    'getValue',
    'setValue',
    'sAlert',
    'sLoading',
    'eLoading',
    'formBtnSLoading',
    'formBtnELoading',
    'alertNotify',
    'textRight',
    'ActiveStatus',
    'myfun',
    'redirectTo',
    'closeModal',
    'refreshContent',
    'orderStatus',
    'getDateFromDateAndTime',

    //ajax.js
    'myAjax',
    'ajaxRequest',
    'ajaxJsonRequest',
    'associateErrors',
    'sendData'
];

// functionsToAssign.forEach(fn => {
//     window[fn] = helper[fn];
// });


functionsToAssign.forEach(fn => {
    if (helper[fn]) {
        window[fn] = helper[fn];
    } else if (helper.ajax[fn]) {
        window[fn] = helper.ajax[fn];
    }
});



import "https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js";
import "https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js";
import "https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js";
