var Global = Global || {};


(function($){


    Global.Controller = (function(self) {

        var elements = {};
        var values = {};

        var construct = function construct() {

            setValues();
            setElements();

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

                    elements.dateInput.val(moment(date).format('YYYY-MM-DD hh:mm:ss'));
                });

            elements.datePickerBtn.addEventListener('click', function() {
                picker.open();
            }, false);

        };

        var setValues = function setValues() {

            values.crsfToken = $('meta[name="csrf-token"]').attr('content');

        };

        var setElements = function setElements() {

            elements.doc = $(document);
            elements.datePickerBtn = document.getElementById('datepicker-btn');
            elements.dateInput = $('#datepicker-btn input');

        };

        return {
            init: construct,
            elements: elements
        };

    })(Global.Controller || {});

    $(document).ready(Global.Controller.init);


})(jQuery);
