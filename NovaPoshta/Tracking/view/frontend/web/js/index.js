/**
 *
 */
define(['jquery'], function ($) {
    'use strict';

    return function (config, node) {
        var container = $(node),
            btnSubmit2 = container.find('button[type=submit]'),
            infoArea = container.find('.show-track');
        // var btnSubmit2 = $('button[type=submit]', container);

        /**
         *
         */
        function showInfoArea(data) {
            if (data.success === true) {
                infoArea.hide();
                infoArea.find('.name').text(data.data[0].RecipientFullName);
                infoArea.find('.address').text(data.data[0].WarehouseRecipientAddress);
                infoArea.show();
            }

        }

        /**
         *
         */
        function sendRequest(docNumber) {
            var dataJson = JSON.stringify({
                apiKey: '1d91c1d6d6c7e9f01d41fd26ddaabf90',
                modelName: 'TrackingDocument',
                calledMethod: 'getStatusDocuments',
                methodProperties: {
                    Documents: [
                        {
                            DocumentNumber: docNumber,
                            Phone: '+380977923789'
                        }
                    ]
                }
            });

            $.ajax(
                {
                    type: 'POST',
                    url: 'http://api.novaposhta.ua/v2.0/json/',
                    contentType: 'application/json',
                    dataType: 'json',
                    data: dataJson
                }
            ).done(function (data) {
                console.log(data);
                showInfoArea(data);
            });
        }

        btnSubmit2.on('click', function (event) {
            event.preventDefault();
            var ttn = container.find('input[id=ttn]')[0].value;

            sendRequest(ttn);
        });
        // var btnSubmit = container.find('button[type=submit]')[0];
        // btnSubmit.onclick =  function (event) {
        //     event.preventDefault();
        //     var ttn = container.find('input[id=ttn]')[0].value;
        // };
        debugger;

    };
});

