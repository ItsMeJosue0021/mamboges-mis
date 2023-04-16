$(document).ready(function () {
    fetch_students_data()

    function fetch_students_data() {
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
});