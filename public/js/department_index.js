$(document).ready(function() {
    const add_department_btn = $('#add-department');
    const add_department_modal = $('#add-department-modal');

    add_department_btn.click(function() {
        add_department_modal.removeClass('hidden');
    });

    const cancel_add_department = $('#cancel');

    cancel_add_department.click(function() {
        add_department_modal.addClass('hidden');
        $('#faculty-form')[0].reset();
        setTimeout(function(){
            location.reload();
        }, 1000);
    });

     //  DELETE DEPARTMENT MODAL
    const delete_btns = $('.show-delete-modal');
    const delete_modal = $('#delete-modal');

    delete_btns.click(function() {
        const department_id = $(this).data('department-id');
        $('#delete-department-id').val(department_id);
        delete_modal.removeClass('hidden');
    });
    const cancel_delete = $('#delete-cancel');
    cancel_delete.click(function() { delete_modal.addClass('hidden'); });


     // DELETE DEPARTMENT
     $(document).on('click', '.delete-btn', function () {
        const department_id = $('#delete-department-id').val();
        $('.delete-btn').text('Deleting..');
        $.ajax({
            type: 'DELETE',
            url: '/departments/' + department_id + '/delete',
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


    //  EDIT DEPARTMENT MODAL
    const edit_btns = $('.edit-btn');
    const edit_modal = $('#edit-department-modal');

    edit_btns.click(function() {
        const department_id = $(this).data('department-id');
        $('#edit-department-id').val(department_id);
        $.ajax({
            url: '/departments/edit/' + department_id,
            type: 'GET',
            success: function(data) {
                $('#edit_department_name').val(data.name);
                $('#edit_department_head option[value=' + data.faculty_id + ']').prop('selected', true);
            }
        });
        edit_modal.removeClass('hidden');
    });

    const edit_cancel_btn = $('#edit-cancel');

    edit_cancel_btn.click(function() {
        edit_modal.addClass('hidden');
        $('#edit-department-form')[0].reset();
    });


    // SAVE DEPARTMENT
    if ($("#department-form").length > 0) {
        $("#department-form").validate({
            rules: {
                department_name: {required: true},
            },
            messages: {
                department_name: {required: "Department name is required"},
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.closest('div').find('span'));
            },
            success: function(label) {
                label.closest('div').find('span').empty();
            },

            submitHandler: function(form) {
                var $saveBtn = $('#department-form button[type="submit"]');
                $saveBtn.text('Saving...');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var formData = new FormData(form);
                $.ajax({
                    url: '/departments/save', type: 'POST', data: formData, processData: false, contentType: false,
                    success: function(response) {
                        var message;
                        if (response.success) {
                            message = $('<div class="fixed top-5 left-1/2 bg-green-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                        '<div class="flex space-x-4 items-center border-2 border-green-400 bg-green-100 px-4 py-2 rounded-md">' +
                                            '<i class="bx bx-check text-green-600 text-4xl"></i>' +
                                            '<p class="poppins text-sm text-green-700">' + response.message + '</p>' +
                                        '</div>' +
                                        '</div>');
                            $('#department-form')[0].reset();

                            setTimeout(function(){
                                add_department_modal.addClass('hidden');
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
    if ($("#edit-department-form").length > 0) {
        $("#edit-department-form").validate({
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
                var $saveBtn = $('#edit-department-form button[type="submit"]');
                $saveBtn.text('Updating...');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const department_id = $('#edit-department-id').val();
                var formData = new FormData(form);
                $.ajax({
                    url: '/departments/' + department_id +'/update',
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

                            $('#edit-department-form')[0].reset();
                            edit_modal.addClass('hidden');
                            setTimeout(function(){
                                window.location = "/departments";
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
