<x-guidance-layout>
    <div class="py-2 pt-4 px-8">
        <a class="flex w-fit justify-start items-center space-x-2 group rounded" href="/sections">
            <i class='bx bx-left-arrow-alt text-gray-600 text-2xl group-hover:text-red-700'></i>
            <p class="poppins text-base text-gray-600 group-hover:text-red-700">back</p>
        </a>
    </div>
    <div  id="container" class="w-full h-full flex items-center justify-center">
        <form id="edit-section-form" method="POST" action="javascript:void(0)" class="w-500px flex flex-col space-y-2">
            @csrf
            @method('PUT')
            <div class="w-full flex py-4">
                <h1 class="poppins text-xl text-gray-800 font-medium">EDIT SECTION</h1>
            </div>
            <div class="get-id flex flex-col space-y-1" id="{{$sections->id}}">
                <div class="flex items-baseline space-x-2">
                    <label for="name"
                    class="poppins text-sm font-medium text-gray-600">SECTION</label>
                    <span class="error text-xs text-red-600"></span>
                </div>
                <input type="text" name="name" id="name" value="{{$sections->name}}"
                class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500" placeholder="Section Name">
            </div>
        
            <div class="flex flex-col space-y-1">
                <div class="flex items-baseline space-x-2">
                    <label for="grade_level"
                    class="poppins text-sm font-medium text-gray-600">GRADE LEVEL</label>
                    <span class="error text-xs text-red-600"></span>
                </div>
                <select name="grade_level" id="grade_level" 
                class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                    <option disabled selected value="">Select Grade Level</option>
                    <option value="0" {{ $sections->grade_level == 0 ? 'selected' : '' }}>Kinder</option>
                    <option value="1" {{ $sections->grade_level == 1 ? 'selected' : '' }}>Grade 1</option>
                    <option value="2" {{ $sections->grade_level == 2 ? 'selected' : '' }}>Grade 2</option>
                    <option value="3" {{ $sections->grade_level == 3 ? 'selected' : '' }}>Grade 3</option>
                    <option value="4" {{ $sections->grade_level == 4 ? 'selected' : '' }}>Grade 4</option>
                    <option value="5" {{ $sections->grade_level == 5 ? 'selected' : '' }}>Grade 5</option>
                    <option value="6" {{ $sections->grade_level == 6 ? 'selected' : '' }}>Grade 6</option>
                </select>
            </div>
        
            <div class="flex flex-col space-y-1">
                <div class="flex items-baseline space-x-2">
                    <label for="school_year"
                    class="poppins text-sm font-medium text-gray-600">SCHOOL YEAR</label>
                    <span class="error text-xs text-red-600"></span>
                </div>
                <input type="text" name="school_year" id="school_year" value="{{$sections->school_year}}"
                class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500" placeholder="School Year">
            </div>
        
            <div class="flex flex-col space-y-1">
                <div class="flex items-baseline space-x-2">
                    <label for="adviser"
                    class="poppins text-sm font-medium text-gray-600">ADVISER</label>
                    <span class="error text-xs text-red-600"></span>
                </div>
                <select name="adviser" id="adviser" 
                class="poppins py-2 px-4 text-base border border-gray-300 rounded focus:outline-none focus:border-blue-500">
                    <option disabled selected value="">Select Adviser</option>    
                    @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ $teacher->id == $sections->adviser_faculty_id ? 'selected' : '' }}>{{ $teacher->suffix }} {{ $teacher->first_name }} {{ $teacher->last_name }}</option>
                    @endforeach
                   
                </select>
            </div>
        
            <div class="flex items-center justify-start space-x-4 pt-4 ">
                <button type="submit" 
                    class="poppins text-base font-medium text-white bg-blue-500 hover:bg-blue-600  border border-blue-500 hover:border-blue-600 py-2 px-8 rounded">
                    Update
                </button>
        
                <a id="cancel" href="/sections"
                    class="poppins text-base font-medium text-gray-400 border border-gray-400 hover:border-red-600 hover:text-red-600 py-2 px-6 rounded cursor-pointer">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-guidance-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>
    $(document).ready(function() {
        if ($("#edit-section-form").length > 0) {
            $("#edit-section-form").validate({
                rules: {
                    name: {
                        required: true
                    },
                    grade_level: {
                        required: true
                    },
                    school_year: {
                        required: true
                    },
                    adviser: {
                        required: true
                    }
                },
                messages: {
                    title: {
                        required: "Section name is required"
                    },
                    grade_level: {
                        required: "Grade level is required"
                    },
                    school_year: {
                        required: "School year is required"
                    },
                    adviser: {
                        required: "Please select an Adviser"
                    }
                },
                errorPlacement: function(error, element) {
                    error.appendTo(element.closest('div').find('span'));
                },
                success: function(label) {
                    label.closest('div').find('span').empty();
                },

                submitHandler: function(form) {
                    var $saveBtn = $('#edit-section-form button[type="submit"]');
                    $saveBtn.text('Saving...');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
    
                    const section = $('.get-id').attr('id');
                    var formData = new FormData(form);
                    $.ajax({
                        url: '/sections/' + section +'/update',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            var message;
                            if (response.success) {
                                message =  $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-48 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
                                $('#edit-section-form')[0].reset();

                                setTimeout(function(){
                                    window.location = "/sections";
                                }, 2000);
                                
                            } else {
                                message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-48 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');   
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
    });
</script>
