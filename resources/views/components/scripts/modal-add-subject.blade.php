
<x-scripts.jquery-links />

<script type="module">

    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    var section_id =  $('.get-id').attr('id');


    $(document).ready(function () {

        fetch_section_subjects(section_id);

        if ($("#add-subject-form").length > 0) {
            $("#add-subject-form").validate({
                rules: {
                    subject: "required",
                    teacher: "required"
                },
                messages: {
                    first_name: "Please enter the first name",
                    teacher: "Please select a teacher"
                },

                errorPlacement: function(error, element) {
                    error.appendTo(element.closest('div').find('span'));
                },
                success: function(label) {
                    label.closest('div').find('span').empty();
                },

                submitHandler: function(form) {
                    var $saveBtn = $('#add-subject-form button[type="submit"]');
                    $saveBtn.text('Ading...');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    const section = $('.get-id').attr('id');
                    var formData = new FormData(form);
                    $.ajax({
                        url: '/sections/'+ section + '/subjects', type: 'POST', data: formData, processData: false, contentType: false,
                        success: function(response) {
                            var message;
                            if (response.success) {
                                message =  $('<div class="fixed top-5 left-1/2 bg-green-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                            '<div class="flex space-x-4 items-center border-2 border-green-400 bg-green-100 px-4 py-2 rounded-md">' +
                                                '<i class="bx bx-check text-green-600 text-4xl"></i>' +
                                                '<p class="poppins text-sm text-green-700">' + response.message + '</p>' +
                                            '</div>' +
                                            '</div>');

                                $('#add-subject-form')[0].reset();
                                fetch_section_subjects(section);
                                
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

                            $saveBtn.text('Add');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log('Error:', errorThrown);
                            $saveBtn.text('Add');
                        }
                    });
                }
            });
        }

        function fetch_section_subjects(section_id) {
            $.ajax({
                url: "/sections/subjects/all",
                method: "GET",
                data: {
                    section_id: section_id,
                },
                dataType:'json',
                success: function(data) {

                    $('#subjects-list').empty(); 

                    if (data.length > 0) {
                        $.each(data, function (index, subject) {
                            
                            var studentComponent = '<div class="flex justify-between space-x-6 px-2 py-2 border-t border-gray-300">' +
                                '<div class="flex space-x-2">' +
                                '<p class="poppins text-base text-gray-700">' + subject.name + ' - ' + subject.faculty + '</p>' +
                                '</div>' +
                                '<div id="button-container">' +
                                '<button id="' + subject.id + '" class="removesubjectbtn poppins text-xs text-red-500 py-1 px-2  border border-red-500 hover:bg-red-500 hover:text-white">Remove</button>' +
                                '</div>' +
                                '</div>';

                                $('#subjects-list').append(studentComponent);
                        });
                        
                    } else {
                        $('#subjects-list').html('<p class="pt-16 poppins text-red-500 text-sm text-center">No Data Found</p>');
                    }

                    // $('#subjects-list').html(data.subject_data);

                    $('.removesubjectbtn').on('click', function() {
                        const section_id = $('.get-id').attr('id');
                        const removeBtn = $(this);
                        removeBtn.text('Removing..');
                        var subject_id = $(this).attr('id');

                        $.ajax({
                            url: "/sections/subjects/remove",
                            method: "DELETE",
                            data: {
                                subject_id: subject_id,
                                section_id: section_id,
                                _token: csrf_token
                            },
                            success: function(response) {
                                var message;
                                if (response.success) {

                                    message =  $('<div class="fixed top-5 left-1/2 bg-green-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                            '<div class="flex space-x-4 items-center border-2 border-green-400 bg-green-100 px-4 py-2 rounded-md">' +
                                                '<i class="bx bx-check text-green-600 text-4xl"></i>' +
                                                '<p class="poppins text-sm text-green-700">' + response.message + '</p>' +
                                            '</div>' +
                                            '</div>');

                                    removeBtn.text('Removed');
                                    fetch_section_subjects(section_id);
                                    
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

                                removeBtn.text('Remove');
        
                            },
                            error: function(xhr) {
                                removeBtn.text('Error');
                            }
                        });
                    });

                }
            });
        }




    });

</script>