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

    if ($('#updates-form').length > 0) {
        $("#updates-form").validate({
            rules: {
                title: {
                    required: true
                },
                tag: {
                    required: true
                },
                description: {
                    required: true
                },
                image: {
                    accept: "image/jpg,image/jpeg,image/png"
                }
            },
            messages: {
                title: {
                    required: "Title is required"
                },
                tag: {
                    required: "Please include a tag"
                },
                description: {
                    required: "Description cannot be empty"
                },
                image: {
                    accept: "Only JPG, JPEG, and PNG files are allowed."
                }
            },
            errorPlacement: function(error, element) {
                error.appendTo(element.closest('div').find('.error'));
            },
            success: function(label) {
                label.closest('div').find('.error').empty();
            },

            submitHandler: function(form) {
                var $submitButton = $('#updates-form button[type="submit"]');
                $submitButton.text('Posting...');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var formData = new FormData(form);
                $.ajax({
                    url: '/updates/save',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        var message;
                        if (response.success) {
                            message =  $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-48 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
                            $('#updates-form')[0].reset(); 
                            $('#photo-preview').css('background-image', '');
                            photoPlaceholder.show();

                            setTimeout(function(){
                                window.location = "/updates/list";
                            }, 2000);
                            
                        } else {
                            message =  $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-48 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
                        }

                        $('#errormessage').append(message);

                        setTimeout(function(){
                            message.fadeOut('slow', function() {
                                message.remove();
                            });
                        }, 3000);

                        $submitButton.text('Post');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Error:', errorThrown);
                        $submitButton.text('Post');
                    }
                });
            }
        });
    }
});