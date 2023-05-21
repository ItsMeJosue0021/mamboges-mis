$(document).ready(function() {

    const photoInput = $('#photo-input');
    const photoPreview = $('#photo-preview');
    const photoPlaceholder = photoPreview.find('p');
    
    photoInput.on('change', function() {
        const file = this.files[0];
        const reader = new FileReader();
    
        reader.addEventListener('load', function() {
            photoPreview.css('background-image', `url(${reader.result})`);

            if (photoPreview.css('background-image') !== 'none') {
                photoPlaceholder.hide();
            }
        });
    
        if (file) {
            reader.readAsDataURL(file);
        }
    });

    const edit_student_btn = $('#edit-student');
    const edit_student_modal = $('#edit-student-modal');

    edit_student_btn.click(function() {
        edit_student_modal.removeClass('hidden');
    });

    const cancel_edit_student = $('#cancel');

    cancel_edit_student.click(function() {
        edit_student_modal.addClass('hidden');
        $('#edit-student-form')[0].reset();
    });


    //  DELETE STUDENT MODAL
    const delete_btn = $('#show-delete-modal');
    const delete_modal = $('#delete-modal');

    delete_btn.click(function() { 
        const student_id = $(this).data('student-id');
        $('#delete-student-id').val(student_id);
        delete_modal.removeClass('hidden'); 
    
    });

    const cancel_delete = $('#delete-cancel');
    cancel_delete.click(function() { delete_modal.addClass('hidden'); });

    // DELETE STUDENT
    $(document).on('click', '.delete-btn', function () {
        const student_id = $('#delete-student-id').val();
        const reason = $('#reason').val();
        $('.delete-btn').text('Deleting..');
        $.ajax({
            type: 'DELETE',
            url: '/students/' + student_id + '/delete',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                reason: reason 
              },
            success: function(response) {
                if (response.success) {
                    message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-14 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
                } else  {
                    message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-red-100 px-14 py-3"><p class="poppins text-lg text-red-800 ">' + response.message + '</p></div>');
                }

                $('.delete-btn').text('Delete');

                delete_modal.addClass('hidden'); 

                $('#container').append(message);

                setTimeout(function(){
                    location = '/students'
                }, 1000);

            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    });

    if ($("#edit-student-form").length > 0) {
        $("#edit-student-form").validate({
            rules: {
                first_name: "required",
                last_name: "required",
                middle_name: "required",
                sex: "required",
                lrn: {
                required: true,
                pattern: /^\d{9}$/
                },
                dob: "required",
                address: "required",
                email: {
                    required: true,
                    email: true
                },
                parent_first_name: "required",
                parent_last_name: "required",
                parent_middle_name: "required",
                parent_sex: "required",
            },
            messages: {
                first_name: "Please enter the first name",
                last_name: "Please enter the last name",
                middle_name: "Please enter the middle name",
                sex: "Please select a gender",
                lrn: {
                required: "Please enter the LRN",
                pattern: "LRN should be a 9-digit number"
                },
                dob: "Please enter your date of birth",
                address: "Please enter the address",
                email: {
                    required: "Please enter an email",
                    email: 'Please use a valid email'
                },
                parent_first_name: "Please enter the first name",
                parent_last_name: "Please enter the last name",
                parent_middle_name: "Please enter the middle name",
                parent_sex: "Please select a gender",
            },

            errorPlacement: function(error, element) {
                error.appendTo(element.closest('div').find('span'));
            },
            success: function(label) {
                label.closest('div').find('span').empty();
            },

            submitHandler: function(form) {
                var $saveBtn = $('#edit-student-form button[type="submit"]');
                $saveBtn.text('Updating...');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const student_id = $('#edit-student').data('student-id');
                var formData = new FormData(form);
                $.ajax({
                    url: '/students/' + student_id + '/edit', type: 'POST', data: formData, processData: false, contentType: false,
                    success: function(response) {
                        var message;
                        if (response.success) {
                            message =  $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
                            $('#edit-student-form')[0].reset();
                            $('#photo-preview').css('background-image', '');

                            setTimeout(function(){
                                edit_student_modal.addClass('hidden');
                            }, 1000);

                            setTimeout(function(){
                                location.reload();
                            }, 1000);

                        } else {
                            message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');   
                        }

                        $('#container').append(message);

                        setTimeout(function(){
                            message.fadeOut('slow', function() {
                                message.remove();
                            });
                        }, 3000);

                        $saveBtn.text('Update');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error:', errorThrown);
                        $saveBtn.text('Update');
                    }
                });
            }
        });
    }

});

