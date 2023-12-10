<section class="bg-white text-gray-700">
    <div class="container mx-auto tablet:px-24 relative ">
        <div id="container" class="h-auto min-h-screen container px-4 py-24 mx-auto flex sm:flex-nowrap flex-wrap">
            <div
                class="lg:w-2/3 md:w-1/2 h-96 md:h-[550px] bg-gray-300 rounded-lg overflow-hidden sm:mr-10 p-4 flex items-end justify-start relative">
                <iframe class="absolute inset-0 w-full h-full" frameborder="0" title="map" marginheight="0"
                    marginwidth="0" scrolling="no"
                    src="https://maps.google.com/maps?q=Mambog%20elementary%20school%20bacoor%20cavite&t=&z=17&ie=UTF8&iwloc=&output=embed">
                </iframe>
                <div class="bg-white relative flex flex-wrap py-4 rounded shadow-md ">
                    <div class="lg:w-1/2 px-6">
                        <h2 class="poppins title-font font-semibold text-gray-900 tracking-widest text-sm">ADDRESS</h2>
                        <p class="poppins mt-1 text-sm">Mambo III, Bacoor City, Cavite, Region IV - CALABARZON</p>
                    </div>
                    <div class="lg:w-1/2 px-6 mt-4 lg:mt-0">
                        <h2 class="poppins title-font font-semibold text-gray-900 tracking-widest text-sm">EMAIL</h2>
                        <a class="poppins text-indigo-500 leading-relaxed text-sm">mamboges.edu.ph@gmail.com</a>
                        <h2 class="poppins title-font font-semibold text-gray-900 tracking-widest text-sm mt-4">PHONE
                        </h2>
                        <p class="poppins leading-relaxed text-sm">471-10-00</p>
                    </div>
                </div>
            </div>

            <form id="feedback-form" action="javascript:void(0)" class="lg:w-1/3 md:w-1/2">
                @csrf
                <div class="bg-white flex flex-col md:ml-auto w-full md:py-8 mt-8 md:mt-0">

                    {{-- message --}}
                    <div id="messageCntr" class="md:hidden h-12 py-2">

                    </div>
                    {{-- end message --}}

                    <h2 class="poppins text-gray-900 text-xl mb-1 font-semibold title-font">Feedback</h2>
                    <p class="poppins leading-relaxed mb-5 text-gray-600 text-sm">Help us improve, feel free to send us
                        a feedback. You can also send your enquiries here.</p>

                    <div class="relative mb-4">
                        <div class="flex items-center space-x-2">
                            <label for="name" class="poppins leading-7 text-sm text-gray-600">Name</label>
                            <span class="error poppins text-red-500 text-sm"></span>
                        </div>
                        <input type="text" id="name" name="name"
                            class="w-full bg-white rounded border border-gray-300 focus:border-gray-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>

                    <div class="relative mb-4">
                        <div class="flex items-center space-x-2">
                            <label for="email" class="poppins leading-7 text-sm text-gray-600">Email</label>
                            <span class="error poppins text-red-500 text-sm"></span>
                        </div>
                        <input type="email" id="email" name="email"
                            class="w-full bg-white rounded border border-gray-300 focus:border-gray-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>

                    <div class="relative mb-4">
                        <div class="flex items-center space-x-2">
                            <label for="message" class="poppins leading-7 text-sm text-gray-600">Message</label>
                            <span class="error poppins text-red-500 text-sm"></span>
                        </div>
                        <textarea id="message" name="message"
                            class="w-full bg-white rounded border border-gray-300 focus:border-gray-500 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
                    </div>

                    <button id="sendFeedback" type="submit"
                        class="poppins text-white bg-red-600 hover:bg-red-700 py-2 px-6 focus:outline-none rounded text-lg">Send</button>
                    {{-- <p class="poppins text-xs text-gray-500 mt-3">Chicharrones blog helvetica normcore iceland tousled brook viral artisan.</p> --}}

                </div>

            </form>
        </div>

    </div>
</section>

<x-scripts.jquery-links />
<script type="module">
    $(document).ready(function() {
        if ($('#feedback-form').length > 0) {
            $("#feedback-form").validate({
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    message: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Name is required"
                    },
                    email: {
                        required: "Email is required",
                        email: "Email must be valid"
                    },
                    message: {
                        required: "Message is required"
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
                    var $submitButton = $('#feedback-form button[type="submit"]');
                    // Change the text of the button to 'Sending...'
                    $submitButton.text('Sending...');

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        url: '{{ url('/feedback/save') }}',
                        type: 'POST',
                        data: $('#feedback-form').serialize(),
                        success: function(response) {
                            var lgsmessage;
                            var smsmessage;
                            if (response.success) {
                                lgsmessage = $('<div class="fixed top-5 left-1/2 bg-green-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                                '<div class="flex space-x-4 items-center border-2 border-green-400 bg-green-100 px-4 py-2 rounded-md">' +
                                                    '<i class="bx bx-check text-green-600 text-4xl"></i>' +
                                                    '<p class="poppins text-sm text-green-700">' + response.message + '</p>' +
                                                '</div>' +
                                                '</div>');
                                smsmessage = $('<div class="fixed top-5 left-1/2 bg-green-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                                '<div class="flex space-x-4 items-center border-2 border-green-400 bg-green-100 px-4 py-2 rounded-md">' +
                                                    '<i class="bx bx-check text-green-600 text-4xl"></i>' +
                                                    '<p class="poppins text-sm text-green-700">' + response.message + '</p>' +
                                                '</div>' +
                                                '</div>');
                                $('#feedback-form')[0].reset();
                            } else {
                                lgsmessage = $('<div class="fixed top-5 left-1/2 bg-green-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                                '<div class="flex space-x-4 items-center border-2 border-green-400 bg-green-100 px-4 py-2 rounded-md">' +
                                                    '<i class="bx bx-check text-green-600 text-4xl"></i>' +
                                                    '<p class="poppins text-sm text-green-700">' + response.message + '</p>' +
                                                '</div>' +
                                                '</div>');
                                smsmessage = $('<div class="fixed top-5 left-1/2 bg-green-700 transform -translate-x-1/2 z-50 rounded-md">' +
                                                '<div class="flex space-x-4 items-center border-2 border-green-400 bg-green-100 px-4 py-2 rounded-md">' +
                                                    '<i class="bx bx-check text-green-600 text-4xl"></i>' +
                                                    '<p class="poppins text-sm text-green-700">' + response.message + '</p>' +
                                                '</div>' +
                                                '</div>');
                            }

                            if (window.matchMedia("(max-width: 650px)").matches) {
                                $('#messageCntr').append(smsmessage);
                            } else {
                                $('#container').append(lgsmessage);
                            }
                            setTimeout(function() {
                                smsmessage.fadeOut('slow', function() {
                                    smsmessage.remove();
                                });
                            }, 3000);
                            setTimeout(function() {
                                lgsmessage.fadeOut('slow', function() {
                                    lgsmessage.remove();
                                });
                            }, 3000);

                            $submitButton.text('Send');
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log('Error:', errorThrown);
                            $submitButton.text('Send');
                        }
                    });
                }
            });
        }
    });
</script>
