$(document).ready(function() {

    //  ADD SECTION MODAL
    const add_btn = $('#add');
    const add_modal = $('#add-modal');

    add_btn.click(function() {
        add_modal.removeClass('hidden');
    });

    const add_cancel_btn = $('#add-cancel');
    const add_back_btn = $('#add-back');

    add_cancel_btn.click(function() {

        add_modal.addClass('hidden');

        $('#section-form')[0].reset();

        setTimeout(function(){
            location.reload();
        }, 1000);
    });

    add_back_btn.click(function() {
        add_modal.addClass('hidden');
        $('#section-form')[0].reset();
    });

    //  EDIT SECTION MODAL
    const edit_btns = $('.edit-btn');
    const edit_modal = $('#edit-modal');

    edit_btns.click(function() {
        const sectionId = $(this).data('section-id');
        $('#edit-section-id').val(sectionId);
        $.ajax({
            url: '/sections/edit/' + sectionId,
            type: 'GET',
            success: function(data) {
                $('#edit-name').val(data.name);
                $('#edit-grade_level option[value=' + data.grade_level + ']').prop('selected', true);
                $('#edit-adviser option[value=' + data.adviser_faculty_id + ']').prop('selected', true);
            }
        });
        edit_modal.removeClass('hidden');
    });

    const edit_cancel_btn = $('#edit-cancel');
    const edit_back_btn = $('#edit-back');

    edit_cancel_btn.click(function() {
        edit_modal.addClass('hidden');
        $('#edit-section-form')[0].reset();
    });

    edit_back_btn.click(function() {
        edit_modal.addClass('hidden');
        $('#edit-section-form')[0].reset();
    });

    //  DELETE SECTION MODAL
    const delete_btns = $('.show-delete-modal');
    const delete_modal = $('#delete-modal');

    delete_btns.click(function() { 

        const sectionId = $(this).data('section-id');
        $('#delete-section-id').val(sectionId);
        
        delete_modal.removeClass('hidden'); 
    
    });

    const cancel_delete = $('#delete-cancel');
    cancel_delete.click(function() { delete_modal.addClass('hidden'); });

    // DELETE SECTION
    $(document).on('click', '.delete-btn', function () {
        const section = $('#delete-section-id').val();
        $('.delete-btn').text('Deleting..');
        $.ajax({
            type: 'DELETE',
            url: '/sections/' + section + '/delete',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3 z-20"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
                } else  {
                    message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3 z-20"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
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

    // SAVE SECTION
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
                            message =  $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3 z-20"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
                            $('#section-form')[0].reset();
                            
                        } else {
                            message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-red-100 px-20 py-3 z-20"><p class="poppins text-lg text-red-800 ">' + response.message + '</p></div>');   
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

    //EDIT SECTION
    if ($("#edit-section-form").length > 0) {
        $("#edit-section-form").validate({
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
                var $saveBtn = $('#edit-section-form button[type="submit"]');
                $saveBtn.text('Editing...');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const section = $('#edit-section-id').val();
                var formData = new FormData(form);
                $.ajax({
                    url: '/sections/' + section +'/update',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var message;
                        if (response.success) {
                            message =  $('<div class="fixed top-3 w-fit rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-10 py-3 z-20"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
                            $('#edit-section-form')[0].reset();
                            edit_modal.addClass('hidden');
                            setTimeout(function(){
                                window.location = "/sections";
                            }, 1000);
                        } else {
                            message = $('<div class="fixed top-3 w-fit rounded left-1/2 transform -translate-x-1/2 bg-red-100 px-10 py-3 z-20"><p class="poppins text-lg text-red-800 ">' + response.message + '</p></div>');   
                        }
                        $('#container').append(message);
                        setTimeout(function(){
                            message.fadeOut('slow', function() {
                                message.remove();
                            });
                        }, 3000);
                        $saveBtn.text('Edit');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error:', errorThrown);
                        $saveBtn.text('Edit');
                    }
                });
            }
        });
    }

    


});

























//     if ($("#csv-form").length > 0) {
//         $("#csv-form").validate({
//             rules: {
//                 csv: {
//                     required: true,
//                     accept: 'text/csv'
//                 }
//             },
//             messages: {
//                 csv: {
//                     required: 'Please select a file',
//                     accept: 'Only CSV files are allowed'
//                 }
//             },

//             errorPlacement: function(error, element) {
//                 error.appendTo(element.closest('form').find('span'));
//             },
//             success: function(label) {
//                 label.closest('div').find('span').empty();
//             },

//             submitHandler: function(form) {
//                 var $saveBtn = $('#csv-form button[type="submit"]');
//                 $saveBtn.text('Uploading...');

//                 $.ajaxSetup({
//                     headers: {
//                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                     }
//                 });

//                 var formData = new FormData($("#csv-form")[0]);
//                 $.ajax({
//                     url: '/sections/import', type: 'POST', data: formData, processData: false, contentType: false,
//                     success: function(response) {
//                         var message;
//                         if (response.success) {
//                             message =  $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
//                             $('#csv-form')[0].reset();

//                             setTimeout(function(){
//                                 window.location = "/sections";
//                             }, 1000);
                            
//                         } else {
//                             message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');   
//                         }

//                         $('#container').append(message);

//                         setTimeout(function(){
//                             message.fadeOut('slow', function() {
//                                 message.remove();
//                             });
//                         }, 3000);

//                         $saveBtn.text('Upload');
//                     },
//                     error: function(jqXHR, textStatus, errorThrown) {
//                         console.log('Error:', errorThrown);
//                         $saveBtn.text('Upload');
//                     }
//                 });
//             }
//         });
//     }

