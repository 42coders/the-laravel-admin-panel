try {
    window.$ = window.jQuery = require('jquery');
} catch (e) {}


import 'bootstrap';
import 'datatables.net-bs5';
import 'trix';
//import 'datatables.net-responsive-bs';
//import 'datatables.net-responsive-bs5';
//import 'jquery-datatables-checkboxes';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
