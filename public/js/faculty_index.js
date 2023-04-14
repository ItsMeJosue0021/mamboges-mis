$(document).ready(function() {
    const add_faculty_btn = $('#add-faculty');
    const add_faculty_modal = $('#add-facuty-modal');

    add_faculty_btn.click(function() {
        add_faculty_modal.removeClass('hidden');
    });
    
    const cancel_add_faculty = $('#cancel');

    cancel_add_faculty.click(function() {
        add_faculty_modal.addClass('hidden');
        $('#faculty-form')[0].reset();
        setTimeout(function(){
            location.reload();
        }, 1000);
    });

    if ($("#faculty-form").length > 0) {
        $("#faculty-form").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                middle_name: "required",
                sex: "required",
                email: {
                    required: true,
                    email: true
                },
                department: "required",
            },
            messages: {
                first_name: "Please enter the first name",
                last_name: "Please enter the last name",
                middle_name: "Please enter the middle name",
                sex: "Please select a gender",
                email: {
                    required: "Please enter an email",
                    email: 'Please use a valid email'
                },
                department: "Please select a department",
            },

            errorPlacement: function(error, element) {
                error.appendTo(element.closest('div').find('span'));
            },
            success: function(label) {
                label.closest('div').find('span').empty();
            },

            submitHandler: function(form) {
                var $saveBtn = $('#faculty-form button[type="submit"]');
                $saveBtn.text('Saving...');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var formData = new FormData(form);
                $.ajax({
                    url: '/faculties/save', type: 'POST', data: formData, processData: false, contentType: false,
                    success: function(response) {
                        var message;
                        if (response.success) {
                            message =  $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
                            $('#faculty-form')[0].reset();
                            
                        } else {
                            message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');   
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