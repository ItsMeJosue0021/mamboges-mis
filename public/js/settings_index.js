$(document).ready(function () {

    fetch_school_years();

    function fetch_school_years() {
        $.ajax({
            url:"/schoolyears",
            method:'GET',
            dataType:'json',
            success:function(data)
            {
                $('#new_school_year').html(data.school_years);
            }
        });
    }

    if ($("#change-sy-form").length > 0) {
        $("#change-sy-form").validate({
            rules: {
                new_school_year: "required",
            },
            messages: {
                new_school_year: "Please add a name",
            },

            errorPlacement: function(error, element) {
                error.appendTo(element.closest('div').find('span'));
            },
            success: function(label) {
                label.closest('div').find('span').empty();
            },

            submitHandler: function(form) {
                var $saveBtn = $('#change-sy-form button[type="submit"]');
                $saveBtn.text('changing...');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var formData = new FormData(form);
                $.ajax({
                    url: '/schoolyears/change', type: 'POST', data: formData, processData: false, contentType: false,
                    success: function(response) {
                        var message;
                        if (response.success) {
                            message =  $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3 z-20"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');

                        } else {
                            message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-red-100 px-20 py-3 z-20"><p class="poppins text-lg text-red-800 ">' + response.message + '</p></div>');   
                        }

                        $('#container').append(message);

                        setTimeout(function(){
                            message.fadeOut('slow', function() {
                                message.remove();
                            });
                        }, 3000);

                        $saveBtn.text('change');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error:', errorThrown);
                        $saveBtn.text('change');
                    }
                });
            }
        });
    }

    if ($("#add-newSY-form").length > 0) {
        $("#add-newSY-form").validate({
            rules: {
                name: "required",
                start_date: "required",
                end_date: "required"
            },
            messages: {
                name: "Please include a name",
                start_date: "Required",
                end_date: "Required"
            },

            errorPlacement: function(error, element) {
                error.appendTo(element.closest('div').find('span'));
            },
            success: function(label) {
                label.closest('div').find('span').empty();
            },

            submitHandler: function(form) {
                var $saveBtn = $('#add-newSY-form button[type="submit"]');
                $saveBtn.text('adding..');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var formData = new FormData(form);
                $.ajax({
                    url: '/schoolyears/new', type: 'POST', data: formData, processData: false, contentType: false,
                    success: function(response) {
                        var message;
                        if (response.success) {
                            message =  $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3 z-20"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
                            fetch_school_years();

                        } else {
                            message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-red-100 px-20 py-3 z-20"><p class="poppins text-lg text-red-800 ">' + response.message + '</p></div>');   
                        }

                        $('#container').append(message);

                        setTimeout(function(){
                            message.fadeOut('slow', function() {
                                message.remove();
                            });
                        }, 3000);

                        $saveBtn.text('add');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error:', errorThrown);
                        $saveBtn.text('add');
                    }
                });
            }
        });
    }
});