"use strict";
/*
 *  Copyright (C) Interactive Knowledge Development, Inc - All Rights Reserved
 *  * Unauthorized copying of this file, via any medium is strictly prohibited
 *  * Proprietary and confidential
 *  * Written by Roberto Ferro <roberto.ferro@ikdev.eu>, March 2019
 *
 */
Object.defineProperty(exports, "__esModule", { value: true });
var form_utils_1 = require("@ikpanel/form_utils");
var modern_gui_1 = require("@ikpanel/modern-gui");
$(function () {
    var body = $('body');
    $('#content').ckeditor(function () {
    }, {
        language: 'it',
        height: 200
    });
    body.on('click', '.action-save', function () {
        var action = $(this).data('action');
        $.ajax({
            type: 'POST',
            cache: false,
            contentType: false,
            processData: false,
            url: admin_panel_url + "/mod/gallery/image/new",
            data: form_utils_1.default.getInputFormDataJson(),
            beforeSend: function () {
                modern_gui_1.default.loading(true, 'Salvataggio immagine in corso...');
            },
            success: function (data) {
                switch (action) {
                    case 'close':
                        location.href = admin_panel_url + "/mod/gallery/image/edit/" + data;
                        break;
                    default:
                        location.reload();
                        break;
                } // switch
            },
            error: function (xhr) {
                form_utils_1.default.sendNotifications(xhr);
            },
            complete: function () {
                modern_gui_1.default.loading(false);
            }
        });
    });
    var fileReader = new FileReader();
    $('#pic').on('change', function (e) {
        // @ts-ignore
        fileReader.readAsDataURL(e.target.files[0]);
    });
    fileReader.onload = function (e) {
        var mainPic = $('#pic-preview'), mainPicWidth = mainPic.width();
        // @ts-ignore
        mainPic.prop('src', e.target.result);
        mainPic.height(mainPicWidth);
    };
});
