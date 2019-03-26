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
    $('#categoryDescription').ckeditor(function () {
    }, {
        language: 'it',
        height: 500
    });
    body.on('click', '.action-save', function () {
        var object = form_utils_1.default.retrieveAllInputs(), action = $(this).data('action');
        $.ajax({
            type: 'POST',
            url: admin_panel_url + "/mod/gallery/categories/new",
            data: object,
            beforeSend: function () {
                modern_gui_1.default.loading(true, 'Creazione categoria in corso...');
            },
            success: function (data) {
                switch (action) {
                    case 'close':
                        location.reload();
                        break;
                    default:
                        location.href = admin_panel_url + "/mod/gallery/categories/edit/" + data;
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
});
