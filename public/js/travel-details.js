var Global = Global || {};


(function($){


    Global.Controller = (function(self) {

        var elements = {};
        var values = {};

        var construct = function construct() {

            setValues();
            setElements();

            if (typeof(google) !== 'undefined') {
                initAutocomplete();
            }

            $('.mdl-switch__input').on('change', function(e) {

                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': values.crsfToken

                    }

                });

                var state = $(e.target).is(":checked");

                $.post('/travel/'+$(this).data('ref-id')+'/ispublic', { 'state' : state }, function(data) {});

            });

            $('.btn-delete').on('click', function(e) {

                e.preventDefault();

                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': values.crsfToken

                    }

                });

                $.post('/travel/'+$(this).data('ref-id')+'/destroy', { }, function(data) {

                    window.location.reload();

                });

                return false;

            });

            var picker = new MaterialDatetimePicker({})
                .on('submit', function(d) {
                    var date = new Date(d);

                    elements.dateInput.val(moment(date).format('DD.MM.YYYY HH:mm'));
                }).on('cancel', function(d) {
                    elements.dateInput.attr({'value': ''});
                });

            elements.datePickerBtn.addEventListener('click', function() {
                picker.open();
            }, false);

        };

        var initAutocomplete = function initAutocomplete() {
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('searchTextField')),
                {types: ['geocode']});

            // When the user selects an address from the dropdown, populate the address
            // fields in the form.
            autocomplete.addListener('place_changed', fillInAddress);
        };

        var fillInAddress = function fillInAddress() {
            // Get the place details from the autocomplete object.
            var place = autocomplete.getPlace();

            console.log(place);
            //console.log(place.address_components.geometry.location.lng());

            for (var component in values.componentForm) {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }

            document.getElementById('lat').value = place.geometry.location.lat();
            document.getElementById('lng').value = place.geometry.location.lng();

            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (values.componentForm[addressType]) {
                    var val = place.address_components[i][values.componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        };

        var setValues = function setValues() {

            values.crsfToken = $('meta[name="csrf-token"]').attr('content');
            values.componentForm = {
                administrative_area_level_1: 'long_name',
                route: 'long_name',
                postal_code: 'short_name',
                street_number: 'short_name',
                lat: 'short_name',
                lng: 'short_name'
            }

        };

        var setElements = function setElements() {

            elements.doc = $(document);
            elements.datePickerBtn = document.getElementById('datepicker-btn');
            elements.dateInput = $('#datepicker-btn input');
            elements.placeSearch = null;
            elements.autocomplete = null;

        };


        return {
            init: construct,
            elements: elements
        };

    })(Global.Controller || {});

    $(document).ready(Global.Controller.init);


})(jQuery);
