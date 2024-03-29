try {
    //window.$ = window.jQuery = require('jquery');
} catch (e) {}


import 'bootstrap';
import 'trix';
import 'laravel-datatables-vite';
import Uppy from "@uppy/core";
import Dashboard from "@uppy/dashboard";
import Tus from "@uppy/tus";
import ImageEditor from '@uppy/image-editor'
//import Sortable from 'sortablejs';
//import Dropzone from "dropzone";
//import Cropper from "cropperjs";
//require('../../node_modules/cropperjs/dist/cropper');
//import Sortable from 'sortablejs';
//import 'datatables.net-responsive-bs';
//import 'datatables.net-responsive-bs5';
//import 'jquery-datatables-checkboxes';

window.Uppy = Uppy;
window.Dashboard = Dashboard;
window.Tus = Tus;
window.ImageEditor = ImageEditor;


//window.Cropper = Cropper;
//window.Dropzone = Dropzone;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

addEventListener("trix-attachment-add", function(event) {
    if (event.attachment.file) {
        uploadFileAttachment(event.attachment)
    }
})

function uploadFileAttachment(attachment) {
    uploadFile(attachment.file, setProgress, setAttributes)

    function setProgress(progress) {
        attachment.setUploadProgress(progress)
    }

    function setAttributes(attributes) {
        attachment.setAttributes(attributes)
    }
}

function uploadFile(file, progressCallback, successCallback) {
    var formData = createFormData(file);
    var xhr = new XMLHttpRequest();

    xhr.open("POST", base_url + 'trix-upload', true);
    xhr.setRequestHeader( 'X-CSRF-TOKEN', getMeta( 'csrf-token') );

    xhr.upload.addEventListener("progress", function(event) {
        var progress = event.loaded / event.total * 100
        progressCallback(progress)
    })

    xhr.addEventListener("load", function(event) {
        var attributes = {
            url: xhr.responseText,
            href: xhr.responseText + "?content-disposition=attachment"
        }
        successCallback(attributes)
    })

    xhr.send(formData)
}

function createFormData(file) {
    var data = new FormData()
    data.append("Content-Type", file.type)
    data.append("file", file)
    return data
}

function getMeta(metaName) {
    const metas = document.getElementsByTagName('meta');

    for (let i = 0; i < metas.length; i++) {
        if (metas[i].getAttribute('name') === metaName) {
            return metas[i].getAttribute('content');
        }
    }

    return '';
}
