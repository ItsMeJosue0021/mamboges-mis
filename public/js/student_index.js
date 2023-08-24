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

    dobException();

    function dobException() {
        // Set the max date to 5 years ago from today
        var maxDate = new Date();
        maxDate.setFullYear(maxDate.getFullYear() - 5);
        var maxDateString = maxDate.toISOString().slice(0, 10);
        
        // Set the min date to 100 years ago from today
        var minDate = new Date();
        minDate.setFullYear(minDate.getFullYear() - 100);
        var minDateString = minDate.toISOString().slice(0, 10);
        
        // Set the min and max attributes
        $('#dob').attr('max', maxDateString);
        $('#dob').attr('min', minDateString);
    }

    const add_student_btn = $('#add-student');
    const add_student_modal = $('#add-student-modal');

    add_student_btn.click(function() {
        add_student_modal.removeClass('hidden');
    });
    
    const cancel_add_student = $('#cancel');

    cancel_add_student.click(function() {
        add_student_modal.addClass('hidden');
        $('#student-form')[0].reset();
    });

    if ($("#student-form").length > 0) {
        $("#student-form").validate({
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
                parent_contact_no: {
                    pattern: /^\d{11}$/
                },
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
                parent_contact_no: {
                    pattern: "Please enter a valid contact number"
                },
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
                var $saveBtn = $('#student-form button[type="submit"]');
                $saveBtn.text('Saving...');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var formData = new FormData(form);
                $.ajax({
                    url: '/students/register', type: 'POST', data: formData, processData: false, contentType: false,
                    success: function(response) {
                        var message;
                        if (response.success) {
                            message =  $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3 z-20"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
                            $('#student-form')[0].reset();
                            $('#photo-preview').css('background-image', '');
                            photoPlaceholder.show();
                            fetch_students_data();
                            
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

    // var url = $(this).attr('href');
    // var page = url.substring(url.lastIndexOf('=') + 1);
    var page = 1;
    fetch_students_data(page);

    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var url = $(this).attr('href');
        var page = 1;
        if (url !== undefined) {
            page = url.substring(url.lastIndexOf('=') + 1);
        }
        fetch_students_data(page);
    });

    function fetch_students_data(page, query = '', gradeLevel = '') {
        $.ajax({
            url:"/students/search?page=" + page + "&query=" + query + "&gradeLevel" + gradeLevel,
            method:'GET',
            data:{query: query, grade_level: gradeLevel },
            dataType:'json',
            success:function(data)
            {
                $('#students-container').html(data.student_data);
                $('.pagination').html(data.pagination);
                $('#total-student').text(data.total);
                $('#enrolled-student').text(data.enrolled);
            }
        });
    }

    $('#search-student').on('keyup', function(){
        var query = $(this).val();
        fetch_students_data(1, query, '');
    }); 

    $(document).on('click', '.level', function(event) {
        event.preventDefault();
        var gradeLevel = $(this).data('grade-level');
        console.log(gradeLevel);
        fetch_students_data(1, '', gradeLevel);
    });

    $(document).on('click', '.all', function(event) {
        event.preventDefault();
        fetch_students_data(page);
    });


    
});

