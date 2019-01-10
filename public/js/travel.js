var Global = Global || {};

(function($){


    Global.Controller = (function(self) {

        var elements = {};
        var values = {};

        var construct = function construct() {

            setValues();
            setElements();

            $(document).on('change', '.public-switch .mdl-switch__input', function(e) {

                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': values.crsfToken

                    }

                });

                var state = $(e.target).is(":checked");

                $.post('/travel/'+$(this).data('ref-id')+'/ispublic', { 'state' : state }, function(data) {});

            });

            $(document).on('click', '.btn-delete-travel', function(e) {

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

            $('.btn-delete-user').on('click', function(e) {

                e.preventDefault();

                $.ajaxSetup({

                    headers: {

                        'X-CSRF-TOKEN': values.crsfToken

                    }

                });

                $.post('/users/'+$(this).data('ref-id')+'/destroy', { }, function(data) {

                    window.location.reload();

                });

                return false;

            });

        };

        var setValues = function setValues() {

            values.crsfToken = $('meta[name="csrf-token"]').attr('content');

        };

        var setElements = function setElements() {

            elements.doc = $(document);

        };

        return {
            init: construct,
            elements: elements
        };

    })(Global.Controller || {});

    $(document).ready(Global.Controller.init);


})(jQuery);
