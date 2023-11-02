<x-scripts.jquery-links />
<script type="module">

    $(document).ready(function () {

        const delete_btns = $('.show-delete-modal');
        const delete_modal = $('#delete-modal');

        delete_btns.click(function() { 
            const sectionId = $(this).data('section-id');
            $('#delete-section-id').val(sectionId);
            console.log(sectionId);
            
            delete_modal.removeClass('hidden'); 
        });

        const cancel_delete = $('#delete-cancel');
        cancel_delete.click(function() {
             delete_modal.addClass('hidden'); 
        });

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
                    var message;
                    
                    if (response.success) {
                        message =  $('<div class="fixed top-5 left-1/2 bg-green-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                        '<div class="flex space-x-4 items-center border-2 border-green-400 bg-green-100 px-4 py-2 rounded-md">' +
                                            '<i class="bx bx-check text-green-600 text-4xl"></i>' +
                                            '<p class="poppins text-sm text-green-700">' + response.message + '</p>' +
                                        '</div>' +
                                        '</div>');

                        $('#section-form')[0].reset();
                        
                    } else {
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
                    location.reload();

                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        });
    });

</script>