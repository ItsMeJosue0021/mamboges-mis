$(document).ready(function() {
    
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    fetch_students_data();

    var sec = $('.get-id').attr('id');
    fetch_section_students(sec);
    fetch_section_subjects(sec);

    function fetch_students_data(query = '') {
        $.ajax({
            url:"/sections/search",
            method:'GET',
            data:{query: query},
            dataType:'json',
            success:function(data)
            {
                $('#students-container').html(data.student_data);

                $('.addstudentbtn').on('click', function() {
                    const addBtn = $(this);
                    addBtn.text('enrolling..');
                    var student_id = $(this).attr('id');
                    var section_id =  $('.get-id').attr('id');
                    sec = section_id;
                    
                    $.ajax({
                        url: "/sections/students/save",
                        method: "POST",
                        data: {
                            section_id: section_id,
                            student_id: student_id,
                            _token: csrf_token
                        },
                        success: function(response) {
                            var message;

                            if (response.success) {
                                message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');   
                                $('#container').append(message);
    
                                setTimeout(function(){
                                    message.fadeOut('slow', function() {
                                        message.remove();
                                    });
                                }, 3000);
                                
                                addBtn.text('enrolled');
                                fetch_section_students(sec);
                                
                            } else {
                                message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-red-100 px-20 py-3 z-50"><p class="poppins text-lg text-red-800 ">' + response.message + '</p></div>');   
                                $('#container').append(message);
    
                                setTimeout(function(){
                                    message.fadeOut('slow', function() {
                                        message.remove();
                                    });
                                }, 3000);

                                addBtn.text('enroll');
                            }
    
                        },
                        error: function(xhr) {
                            addBtn.text('error');
                        }
                    });
                
                });
            }
        });
    }

    $('#search-student').on('keyup', function(){
        var query = $(this).val();
        fetch_students_data(query);
    }); 

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
                    url: '/sections/'+ section, type: 'POST', data: formData, processData: false, contentType: false,
                    success: function(response) {
                        var message;
                        if (response.success) {
                            message =  $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
                            $('#add-subject-form')[0].reset();
                            fetch_section_subjects(section);
                            // add_subject_modal.addClass('hidden');
                            
                        } else {
                            message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-orange-100 px-20 py-3"><p class="poppins text-lg text-orange-800 ">' + response.message + '</p></div>');   
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

    function fetch_section_students(section_id) {
        $.ajax({
            url: "/sections/students/all",
            method: "GET",
            data: {
                section_id: section_id,
            },
            dataType:'json',
            success: function(data) {
                $('#students-list1').html(data.student_data);
                $('#students-list2').html(data.student_data);
                $('#student-count').text(data.student_count);

                $('.removestudentbtn').on('click', function() {
                    const removeBtn = $(this);
                    removeBtn.text('Removing..');
                    var student_id = $(this).attr('id');

                    $.ajax({
                        url: "/sections/students/remove",
                        method: "DELETE",
                        data: {
                            student_id: student_id,
                            _token: csrf_token
                        },
                        success: function(response) {
                            var message;
                            if (response.success) {
                                removeBtn.text('Removed');
                                fetch_section_students(sec);
                                
                            } else {
                                message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-red-100 px-20 py-3"><p class="poppins text-lg text-red-800 ">' + response.message + '</p></div>');   
                            
                                $('#container').append(message);
                            
                                setTimeout(function(){
                                    message.fadeOut('slow', function() {
                                        message.remove();
                                    });
                                }, 3000);
                                removeBtn.text('Remove');
                            }
    
                        },
                        error: function(xhr) {
                            removeBtn.text('error');
                        }
                    });
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
                $('#subjects-list').html(data.subject_data);

                $('.removesubjectbtn').on('click', function() {
                    const section_id = $('.get-id').attr('id');
                    const removeBtn = $(this);
                    removeBtn.text('removing..');
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
                                removeBtn.text('removed');
                                fetch_section_subjects(sec);
                                
                            } else {
                                message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-red-100 px-20 py-3"><p class="poppins text-lg text-red-800 ">' + response.message + '</p></div>');   
                            
                                $('#container').append(message);
                            
                                setTimeout(function(){
                                    message.fadeOut('slow', function() {
                                        message.remove();
                                    });
                                }, 3000);
                                removeBtn.text('remove');
                            }
    
                        },
                        error: function(xhr) {
                            removeBtn.text('error');
                        }
                    });
                });

            }
        });
    }


    const add_student_btn = $('#add-student');
    const add_student_modal = $('#add-student-modal');

    add_student_btn.click(function() {
        add_student_modal.removeClass('hidden');
    });

    const add_cancel = $('#add-cancel');
    const done = $('#done');

    add_cancel.click(function() {
        add_student_modal.addClass('hidden');
    });

    done.click(function() {
        add_student_modal.addClass('hidden');
    });
    

    const add_subject_btn = $('#add-subject');
    const add_subject_modal = $('#add-subject-modal');

    add_subject_btn.click(function() {
        add_subject_modal.removeClass('hidden');
    });

    const add_subject_cancel = $('#add-subject-cancel');

    add_subject_cancel.click(function() {
        add_subject_modal.addClass('hidden');
    });
 
});