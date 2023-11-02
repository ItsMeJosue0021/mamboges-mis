<x-scripts.jquery-links />
<script type="module">

$(document).ready(function () {

    const add_btn = $('#add');
    const add_modal = $('#add-modal');

    add_btn.click(function() {
        add_modal.removeClass('hidden');
    });

    const add_cancel_btn = $('#add-cancel');

    add_cancel_btn.click(function() {

        add_modal.addClass('hidden');

        $('#section-form')[0].reset();
        location.reload();
    });

    if ($("#section-form").length > 0) {
        $("#section-form").validate({
            rules: {
                name: {required: true},
                grade_level: {required: true},
                adviser: {required: true}
            },
            messages: {
                title: {required: "Section name is required"},
                grade_level: {required: "Grade level is required"},
                adviser: {required: "Please select an Adviser"}
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.closest('div').find('span'));
            },
            success: function(label) {
                label.closest('div').find('span').empty();
            },

            submitHandler: function(form) {
                var $saveBtn = $('#section-form button[type="submit"]');
                $saveBtn.text('Saving...');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var formData = new FormData(form);
                $.ajax({
                    url: '/sections/save', type: 'POST', data: formData, processData: false, contentType: false,
                    success: function(response) {
                        var message;
                        if (response.success) {
                            message =  $('<div class="fixed top-5 left-1/2 bg-green-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                            '<div class="flex space-x-4 items-center border-2 border-green-400 bg-green-100 px-4 py-2 rounded-md">' +
                                                '<i class="bx bx-check text-green-600 text-4xl"></i>' +
                                                '<p class="poppins text-sm text-green-700">' + response.message + '</p>' +
                                            '</div>' +
                                            '</div>');

                            $('#section-form')[0].reset();
                            
                        } else {
                            message = $('<div class="fixed top-5 left-1/2 bg-red-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                        '<div class="flex space-x-4 items-center border-2 border-red-400 bg-red-100 px-4 py-2 rounded-md">' +
                                            '<i class="bx bx-block text-red-500 text-4xl"></i>' +
                                            '<p class="poppins text-sm text-red-700">' + response.message + '</p>' +
                                        '</div>' +
                                        '</div>');
                        }

                        $('#container').append(message);

                        setTimeout(function(){
                            message.fadeOut('slow', function() {
                                message.remove();
                            });
                        }, 3000);

                        $saveBtn.text('Save');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error:', errorThrown);
                        $saveBtn.text('Save');
                    }
                });
            }
        });
    }

});

</script>