$(document).ready(function() {
    const edit_faculty_btn = $('#edit-faculty');
    const edit_faculty_modal = $('#edit-facuty-modal');

    edit_faculty_btn.click(function() {
        edit_faculty_modal.removeClass('hidden');
    });
    
    const cancel_edit_faculty = $('#cancel');

    cancel_edit_faculty.click(function() {
        edit_faculty_modal.addClass('hidden');
    });

    //  DELETE FACULTY MODAL
    const delete_btn = $('#show-delete-modal');
    const delete_modal = $('#delete-modal');

    delete_btn.click(function() { 
        const faculty_id = $(this).data('faculty-id');
        $('#delete-faculty-id').val(faculty_id);
        delete_modal.removeClass('hidden'); 
    });

    const cancel_delete = $('#delete-cancel');
    cancel_delete.click(function() { delete_modal.addClass('hidden'); });

    // DELETE FACULTY
    $(document).on('click', '.delete-btn', function () {
        const faculty_id = $('#delete-faculty-id').val();
        $('.delete-btn').text('Deleting..');
        $.ajax({
            type: 'DELETE',
            url: '/faculties/' + faculty_id + '/delete',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3 z-20"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
                } else  {
                    message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-red-100 px-20 py-3 z-20"><p class="poppins text-lg text-red-800 ">' + response.message + '</p></div>');
                }

                $('.delete-btn').text('Delete');

                delete_modal.addClass('hidden'); 

                $('#container').append(message);

                setTimeout(function(){
                    location = '/faculties'
                }, 1000);

            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    });

    //EDIT FACULTY
    if ($("#edit-faculty-form").length > 0) {
        $("#edit-faculty-form").validate({
            rules: {
                first_name: "required",
                last_name: "required",
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
                department: "Please select a Department",
            },

            errorPlacement: function(error, element) {
                error.appendTo(element.closest('div').find('span'));
            },
            success: function(label) {
                label.closest('div').find('span').empty();
            },

            submitHandler: function(form) {
                var $saveBtn = $('#edit-faculty-form button[type="submit"]');
                $saveBtn.text('Updating...');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const faculty_id = $('#edit-faculty').data('faculty-id');
                var formData = new FormData(form);
                $.ajax({
                    url: '/faculties/' + faculty_id + '/update', type: 'POST', data: formData, processData: false, contentType: false,
                    success: function(response) {
                        var message;
                        if (response.success) {
                            message =  $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3 z-20"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
                            $('#edit-faculty-form')[0].reset();

                            setTimeout(function(){
                                edit_faculty_modal.addClass('hidden');
                                location.reload();
                            }, 1000);

                            // setTimeout(function(){
                            //     location.reload();
                            // }, 1000);

                        } else {
                            message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-red-100 px-20 py-3 z-20"><p class="poppins text-lg text-red-800 ">' + response.message + '</p></div>');   
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