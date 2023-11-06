<script type="module">
    var csrf_token = $('meta[name="csrf-token"]').attr('content');
    var section_id = $('.get-id').attr('id');

    $(document).ready(function() {

        searchStudent();
        fetch_section_students(section_id)

        function searchStudent(query = '') {
            $.ajax({
                url: '/sections/search',
                type: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    $('#students-list-container').empty();

                    if (data.length > 0) {
                        $.each(data, function(index, student) {

                            var studentComponent =
                                '<div class="flex justify-between space-x-6 px-2 py-2 border-t border-gray-300">' +
                                '<div class="flex space-x-2">' +
                                '<p class="poppins text-base text-gray-700">' + student
                                .firstName + ' ' + student.middleName + ' ' + student
                                .lastName + '</p>' +
                                '</div>' +
                                '<div id="button-container">' +
                                '<button id="' + student.id +
                                '" class="addstudentbtn poppins text-xs text-blue-500 py-1 px-2  border border-blue-500 hover:bg-blue-500 hover:text-white">Enroll</button>' +
                                '</div>' +
                                '</div>';

                            $('#students-list-container').append(studentComponent);
                        });
                        addStudent();
                    } else {
                        $('#students-list-container').html(
                            '<p class="pt-16 poppins text-red-500 text-sm text-center">No Data Found</p>'
                            );
                    }
                },

                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        $('#search-student').on('keyup', function(e) {
            var query = $('#search-student').val();
            searchStudent(query);
        });



        function addStudent() {
            $('.addstudentbtn').on('click', function() {
                var btn = $(this);
                btn.text('Enrolling..');
                var student_id = $(this).attr('id');
                var section_id = $('.get-id').attr('id');

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
                            message = $(
                                '<div class="fixed top-5 left-1/2 bg-green-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                '<div class="flex space-x-4 items-center border-2 border-green-400 bg-green-100 px-4 py-2 rounded-md">' +
                                '<i class="bx bx-check text-green-600 text-4xl"></i>' +
                                '<p class="poppins text-sm text-green-700">' + response
                                .message + '</p>' +
                                '</div>' +
                                '</div>');

                            btn.text('Enrolled');
                            searchStudent();
                            fetch_section_students(section_id);

                        } else {

                            message = $(
                                '<div class="fixed top-5 left-1/2 bg-red-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                '<div class="flex space-x-4 items-center border-2 border-red-400 bg-red-100 px-4 py-2 rounded-md">' +
                                '<i class="bx bx-block text-red-500 text-4xl"></i>' +
                                '<p class="poppins text-sm text-red-700">' + response
                                .message + '</p>' +
                                '</div>' +
                                '</div>');

                            btn.text('Enroll');
                        }

                        $('#container').append(message);

                        setTimeout(function() {
                            message.fadeOut('slow', function() {
                                message.remove();
                            });
                        }, 3000);

                    },
                    error: function(xhr) {
                        btn.text('Enroll');
                    }
                });

            });
        }

        function fetch_section_students(section_id) {
            $.ajax({
                url: "/sections/students/all",
                method: "GET",
                data: {
                    section_id: section_id,
                },
                dataType: 'json',
                success: function(data) {

                    $('#students-list1').empty();
                    $('#students-list2').empty();

                    if (data.studentCount > 0) {
                        $.each(data.students, function(index, student) {

                            var studentComponent =
                                '<div class="flex justify-between space-x-6 px-2 py-2 border-t border-gray-300">' +
                                '<div class="flex space-x-2">' +
                                '<p class="poppins text-base text-gray-700">' + student
                                .firstName + ' ' + student.middleName + ' ' + student
                                .lastName + '</p>' +
                                '</div>' +
                                '<div id="button-container">' +
                                '<button id="' + student.id +
                                '" class="removestudentbtn poppins text-xs text-red-500 py-1 px-2  border border-red-500 hover:bg-red-500 hover:text-white">Remove</button>' +
                                '</div>' +
                                '</div>';
                            $('#students-list1').append(studentComponent);
                            $('#students-list2').append(studentComponent);
                        });

                        $('#student-count').text(data.studentCount);

                        removeStudent();

                    } else {
                        $('#students-list1').html(
                            '<p class="pt-16 poppins text-red-500 text-sm text-center">No Data Found</p>'
                            );
                        $('#students-list2').html(
                            '<p class="pt-16 poppins text-red-500 text-sm text-center">No Data Found</p>'
                            );
                    }
                }
            });

        }

        function removeStudent() {
            $('.removestudentbtn').on('click', function() {
                const removeBtn = $(this);
                removeBtn.text('Removing..');
                var sectionStudentId = $(this).attr('id');

                $.ajax({
                    url: "/sections/students/remove",
                    method: "DELETE",
                    data: {
                        sectionStudentId: sectionStudentId,
                        _token: csrf_token
                    },
                    success: function(response) {
                        var message;
                        if (response.success) {
                            message = $(
                                '<div class="fixed top-5 left-1/2 bg-green-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                '<div class="flex space-x-4 items-center border-2 border-green-400 bg-green-100 px-4 py-2 rounded-md">' +
                                '<i class="bx bx-check text-green-600 text-4xl"></i>' +
                                '<p class="poppins text-sm text-green-700">' + response
                                .message + '</p>' +
                                '</div>' +
                                '</div>');

                            removeBtn.text('Removed');
                            searchStudent();
                            fetch_section_students(section_id);

                        } else {
                            message = $(
                                '<div class="fixed top-5 left-1/2 bg-red-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                '<div class="flex space-x-4 items-center border-2 border-red-400 bg-red-100 px-4 py-2 rounded-md">' +
                                '<i class="bx bx-block text-red-500 text-4xl"></i>' +
                                '<p class="poppins text-sm text-red-700">' + response
                                .message + '</p>' +
                                '</div>' +
                                '</div>');
                        }

                        $('#container').append(message);

                        setTimeout(function() {
                            message.fadeOut('slow', function() {
                                message.remove();
                            });
                        }, 3000);

                    },
                    error: function(xhr) {
                        removeBtn.text('Error');
                    }
                });
            });
        }


    });
</script>
