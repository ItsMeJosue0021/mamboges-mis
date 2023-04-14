<x-guidance-layout>
    <div id="errormessage" class="h-700p w-full flex flex-col">
        <div class="py-2 pt-4 px-8">
            <a class="flex w-fit justify-start items-center space-x-2 group rounded" href="/updates/list">
                <i class='bx bx-left-arrow-alt text-gray-600 text-2xl group-hover:text-red-700'></i>
                <p class="poppins text-base text-gray-600 group-hover:text-red-700">back</p>
            </a>
        </div>
        <form id="updates-form" method="POST" action="javascript:void(0)" class="h-full w-full flex flex-col px-8 relative" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="get-id flex h-full w-full items-start space-x-4 py-2" id="{{$updates->id}}">
                <div class="w-1/2 flex flex-col ">
                    <div id="photo-preview" class="h-400px flex items-center justify-center bg-gray-100 bg-cover bg-center rounded shadow-md"
                        style="background-image: url('{{ asset('storage/' . $updates->image) }}')">
                        @if (!$updates->image)
                            <p class="poppins text-3xl text-gray-400 font-semibold">Upload a photo</p>
                        @endif
                    </div>
                    <div class="relative py-4">
                        <label>
                            <input name="image" type="file" id="photo-input" class="poppins text-sm mr-2
                            file:mr-5 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-medium
                            file:bg-gray-100 file:text-gray-600
                            hover:file:cursor-pointer hover:file:bg-green-100
                            hover:file:text-green-600" 
                            value="{{$updates->image}}"/>
                        </label>
                        <span class="error poppins text-red-500 text-sm"></span>
                    </div>
                    <div class="w-full flex space-x-4 items-center py-4">
                        <button type="submit" 
                        class="poppins text-base text-white bg-blue-500 hover:bg-blue-600 border border-blue-500 hover:border-blue-600 py-2 px-10 rounded">Save</button>
                        <a href="/updates/list" 
                        class="poppins py-2 px-6 text-base text-red-600 border border-red-400 hover:border-red-400 hover:text-red-600 rounded">Cancel</a>
                    </div>
                </div>
                <div class="w-1/2 flex flex-col space-y-4">
                    <div class="flex flex-col">
                        <div class="flex items-center space-x-2">
                            <label class="poppins text-base text-gray-700 font-semibold" for="title">Title</label>
                            <span class="error poppins text-red-500 text-sm"></span>
                        </div>
                        <input id="title" name="title" class="poppins text-sm py-2 px-4 border rounded focus:outline-none border-gray-400 focus:border-gray-600" 
                            type="text" 
                            placeholder="Type the title here"
                            value="{{$updates->title}}">
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center space-x-2">
                            <label class="poppins text-base text-gray-700 font-semibold" for="title">Tags</label>
                            <span class="error poppins text-red-500 text-sm"></span>
                        </div>
                        <input id="tag" name="tag" class="poppins text-sm py-2 px-4 border rounded focus:outline-none border-gray-400 focus:border-gray-600" 
                            type="text" 
                            placeholder="Type the title here"
                            value="{{$updates->tag}}">
                    </div>
                    <div class="flex flex-col h-96">
                        <div class="flex items-center space-x-2">
                            <label class="poppins text-base text-gray-700 font-semibold py-2" for="description">Description</label>
                            <span class="error poppins text-red-500 text-sm"></span>
                        </div>
                        <textarea id="description" name="description" class="h-400px poppins text-sm py-2 px-4 border rounded focus:outline-none border-gray-400 focus:border-gray-600" 
                        type="text" placeholder="Type the description here">
                        {{$updates->description}}</textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>  
</x-guidance-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {
        const photoInput = $('#photo-input');
        const photoPreview = $('#photo-preview');
        const photoPlaceholder = photoPreview.find('p');
        const update = $('.get-id').attr('id');
      
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
                    // Store a reference to the button element
                    var $submitButton = $('#updates-form button[type="submit"]');
                    // Change the text of the button to 'Sending...'
                    $submitButton.text('Posting...');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
    
                    var formData = new FormData(form);
                    $.ajax({
                        url: '/updates/' + update + '/update',
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
                                $('#updates-form input[type="text"]').val('');
                                $('#updates-form textarea').val('');
                                $('#updates-form input[type="file"]').val('');
                                window.location.href = '/updates/list';
                                
                            } else {
                                message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-48 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
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
</script>