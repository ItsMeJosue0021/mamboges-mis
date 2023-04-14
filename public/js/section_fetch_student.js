$(document).ready(function () {
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    fetch_students_data();

    var sec = $('.get-id').attr('id');
    fetch_section_students(sec);

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
                        method: "PUT",
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

 
    function fetch_students_data(query = '') {
        $.ajax({
            url:"/sections/search",
            method:'GET',
            data:{query:query},
            dataType:'json',
            success:function(data)
            {
                $('#students-container').html(data.student_data);

                $('.addstudentbtn').on('click', function() {
                    const addBtn = $(this);
                    addBtn.text('adding..');
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
                                addBtn.text('added');
                                fetch_section_students(sec);
                                
                            } else {
                                message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-red-100 px-20 py-3"><p class="poppins text-lg text-red-800 ">' + response.message + '</p></div>');   
                                $('#container').append(message);
    
                                setTimeout(function(){
                                    message.fadeOut('slow', function() {
                                        message.remove();
                                    });
                                }, 3000);

                                addBtn.text('add');
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

    $('#search').on('keyup', function(){
        var query = $(this).val();
        fetch_students_data(query);
    }); 
 
});