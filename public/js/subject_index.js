$(document).ready(function() {
    const add_subject_btn = $('#add-subject');
    const add_subject_modal = $('#add-subject-modal');

    add_subject_btn.click(function() {
        add_subject_modal.removeClass('hidden');
    });

    const cancel_add_subject = $('#cancel');

    cancel_add_subject.click(function() {
        add_subject_modal.addClass('hidden');
        $('#subject-form')[0].reset();
        setTimeout(function(){
            location.reload();
        }, 1000);
    });

     //  DELETE STUDENT MODAL
    const delete_btns = $('.show-delete-modal');
    const delete_modal = $('#delete-modal');

    delete_btns.click(function() {
        const subject_id = $(this).data('subject-id');
        $('#delete-subject-id').val(subject_id);
        delete_modal.removeClass('hidden');
    });
    const cancel_delete = $('#delete-cancel');
    cancel_delete.click(function() { delete_modal.addClass('hidden'); });


     // DELETE SECTION
     $(document).on('click', '.delete-btn', function () {
        const subject_id = $('#delete-subject-id').val();
        $('.delete-btn').text('Deleting..');
        $.ajax({
            type: 'DELETE',
            url: '/subjects/' + subject_id + '/delete',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                var message;
                if (response.success) {
                    message = $('<div class="fixed top-5 left-1/2 bg-green-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                '<div class="flex space-x-4 items-center border-2 border-green-400 bg-green-100 px-4 py-2 rounded-md">' +
                                    '<i class="bx bx-check text-green-600 text-4xl"></i>' +
                                    '<p class="poppins text-sm text-green-700">' + response.message + '</p>' +
                                '</div>' +
                                '</div>');
                } else  {
                    message = $('<div class="fixed top-5 left-1/2 bg-red-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                '<div class="flex space-x-4 items-center border-2 border-red-400 bg-red-100 px-4 py-2 rounded-md">' +
                                    '<i class="bx bx-block text-red-500 text-4xl"></i>' +
                                    '<p class="poppins text-sm text-red-700">' + response.message + '</p>' +
                                '</div>' +
                                '</div>');
                }

                $('.delete-btn').text('Delete');

                delete_modal.addClass('hidden');

                $('#container').append(message);

                setTimeout(function(){
                    location.reload();
                }, 1000);

            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    });


    //  EDIT SECTION MODAL
    const edit_btns = $('.edit-btn');
    const edit_modal = $('#edit-subject-modal');

    edit_btns.click(function() {
        const subject_id = $(this).data('subject-id');
        $('#edit-subject-id').val(subject_id);
        $.ajax({
            url: '/subjects/edit/' + subject_id,
            type: 'GET',
            success: function(data) {
                $('#edit_subject_name').val(data.name);
            }
        });
        edit_modal.removeClass('hidden');
    });

    const edit_cancel_btn = $('#edit-cancel');

    edit_cancel_btn.click(function() {
        edit_modal.addClass('hidden');
        $('#edit-subject-form')[0].reset();
    });


    // SAVE SUBJECT
    if ($("#subject-form").length > 0) {
        $("#subject-form").validate({
            rules: {
                subject_name: {required: true},
                grade_level: {required: true},
            },
            messages: {
                subject_name: {required: "Please inlcude the subject's name"},
                grade_level: {required: "Please select a grade level"},
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.closest('div').find('span'));
            },
            success: function(label) {
                label.closest('div').find('span').empty();
            },

            submitHandler: function(form) {
                var $saveBtn = $('#subject-form button[type="submit"]');
                $saveBtn.text('Saving...');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var formData = new FormData(form);
                $.ajax({
                    url: '/subjects/save', type: 'POST', data: formData, processData: false, contentType: false,
                    success: function(response) {
                        var message;
                        if (response.success) {
                            message = $('<div class="fixed top-5 left-1/2 bg-green-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                        '<div class="flex space-x-4 items-center border-2 border-green-400 bg-green-100 px-4 py-2 rounded-md">' +
                                            '<i class="bx bx-check text-green-600 text-4xl"></i>' +
                                            '<p class="poppins text-sm text-green-700">' + response.message + '</p>' +
                                        '</div>' +
                                        '</div>');
                            $('#subject-form')[0].reset();

                            setTimeout(function(){
                                add_subject_modal.addClass('hidden');
                                location.reload();
                            }, 1000);

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

    //EDIT DEPARTMENT
    if ($("#edit-subject-form").length > 0) {
        $("#edit-subject-form").validate({
            rules: {
                edit_department_name: {required: true},
            },
            messages: {
                edit_department_name: {required: "Department name is required"},
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.closest('div').find('span'));
            },
            success: function(label) {
                label.closest('div').find('span').empty();
            },

            submitHandler: function(form) {
                var $saveBtn = $('#edit-subject-form button[type="submit"]');
                $saveBtn.text('Updating...');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const subject_id = $('#edit-subject-id').val();
                var formData = new FormData(form);
                $.ajax({
                    url: '/subjects/' + subject_id +'/update',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var message;
                        if (response.success) {
                            message = $('<div class="fixed top-5 left-1/2 bg-green-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                        '<div class="flex space-x-4 items-center border-2 border-green-400 bg-green-100 px-4 py-2 rounded-md">' +
                                            '<i class="bx bx-check text-green-600 text-4xl"></i>' +
                                            '<p class="poppins text-sm text-green-700">' + response.message + '</p>' +
                                        '</div>' +
                                        '</div>');
                            $('#edit-subject-form')[0].reset();
                            edit_modal.addClass('hidden');
                            setTimeout(function(){
                                window.location = "/subjects";
                            }, 1000);
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
