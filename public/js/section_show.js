// $(document).ready(function() {
//     const addButton = $('#add');
//     const modal = $('#modal');

//     addButton.click(function() {
//         modal.removeClass('hidden');
//     });

//     const cancelButton = $('#cancel');
//     const backButton = $('#backfromadd');

//     cancelButton.click(function() {
//         modal.addClass('hidden');
//         $('#student-form')[0].reset();
//     });

//     backButton.click(function() {
//         modal.addClass('hidden');
//         $('#student-form')[0].reset();
//     });


//     const add_student_btn = $('#add-student');
//     const add_student_modal = $('#add-student-modal');

//     add_student_btn.click(function() {
//         add_student_modal.removeClass('hidden');
//     });

//     const add_cancel = $('#add-cancel');
//     const done = $('#done');

//     add_cancel.click(function() {
//         add_student_modal.addClass('hidden');
//     });

//     done.click(function() {
//         add_student_modal.addClass('hidden');
//     });
    

//     const add_subject_btn = $('#add-subject');
//     const add_subject_modal = $('#add-subject-modal');

//     add_subject_btn.click(function() {
//         add_subject_modal.removeClass('hidden');
//     });

//     const add_subject_cancel = $('#add-subject-cancel');

//     add_subject_cancel.click(function() {
//         add_subject_modal.addClass('hidden');
//     });





//     // $(document).on('click', '.delete-btn', function () {
//     //     var sectionId = $(this).data('section-id');
//     //     if (confirm('Are you sure you want to delete this section?')) {
//     //         $.ajax({
//     //             type: 'DELETE',
//     //             url: '/sections/' + sectionId + '/delete',
//     //             headers: {
//     //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     //             },
//     //             success: function(response) {
//     //                 if (response.success) {
//     //                     message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
//     //                 } else  {
//     //                     message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
//     //                 }

//     //                 $('#container').append(message);

//     //                 setTimeout(function(){
//     //                     location.reload();
//     //                 }, 1000);
//     //             },
//     //             error: function(xhr, status, error) {
//     //                 console.log('Error:', error);
//     //             }
//     //         });
//     //     }
//     // });

//     if ($("#student-form").length > 0) {
//         $("#student-form").validate({
//             rules: {
//                 first_name: "required",
//             },
//             messages: {
//                 first_name: "Please enter the first name",
//             },

//             errorPlacement: function(error, element) {
//                 error.appendTo(element.closest('div').find('span'));
//             },
//             success: function(label) {
//                 label.closest('div').find('span').empty();
//             },

//             submitHandler: function(form) {
//                 var $saveBtn = $('#student-form button[type="submit"]');
//                 $saveBtn.text('Saving...');

//                 $.ajaxSetup({
//                     headers: {
//                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                     }
//                 });

//                 const section = $('.get-id').attr('id');
//                 var formData = new FormData(form);
//                 $.ajax({
//                     url: '/sections/'+ section + '/savestudent', type: 'POST', data: formData, processData: false, contentType: false,
//                     success: function(response) {
//                         var message;
//                         if (response.success) {
//                             message =  $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
//                             $('#student-form')[0].reset();
                            
//                         } else {
//                             message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');   
//                         }

//                         $('#container').append(message);

//                         setTimeout(function(){
//                             message.fadeOut('slow', function() {
//                                 message.remove();
//                             });
//                         }, 3000);

//                         $saveBtn.text('Save');
//                     },
//                     error: function(jqXHR, textStatus, errorThrown) {
//                         console.log('Error:', errorThrown);
//                         $saveBtn.text('Save');
//                     }
//                 });
//             }
//         });
//     }

//     // if ($("#student-form").length > 0) {
//     //     $("#student-form").validate({
//     //         rules: {
//     //             first_name: "required",
//     //             last_name: "required",
//     //             middle_name: "required",
//     //             sex: "required",
//     //             lrn: {
//     //             required: true,
//     //             pattern: /^\d{9}$/
//     //             },
//     //             dob: "required",
//     //             address: "required",
//     //             email: {
//     //                 required: true,
//     //                 email: true
//     //             },
//     //             parent_first_name: "required",
//     //             parent_last_name: "required",
//     //             parent_middle_name: "required",
//     //             parent_sex: "required",


//     //         },
//     //         messages: {
//     //             first_name: "Please enter the first name",
//     //             last_name: "Please enter the last name",
//     //             middle_name: "Please enter the middle name",
//     //             sex: "Please select a gender",
//     //             lrn: {
//     //             required: "Please enter the LRN",
//     //             pattern: "LRN should be a 9-digit number"
//     //             },
//     //             dob: "Please enter your date of birth",
//     //             address: "Please enter the address",
//     //             email: {
//     //                 required: "Please enter an email",
//     //                 email: 'Please use a valid email'
//     //             },
//     //             parent_first_name: "Please enter the first name",
//     //             parent_last_name: "Please enter the last name",
//     //             parent_middle_name: "Please enter the middle name",
//     //             parent_sex: "Please select a gender",
//     //         },

//     //         errorPlacement: function(error, element) {
//     //             error.appendTo(element.closest('div').find('span'));
//     //         },
//     //         success: function(label) {
//     //             label.closest('div').find('span').empty();
//     //         },

//     //         submitHandler: function(form) {
//     //             var $saveBtn = $('#student-form button[type="submit"]');
//     //             $saveBtn.text('Saving...');

//     //             $.ajaxSetup({
//     //                 headers: {
//     //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     //                 }
//     //             });

//     //             const section = $('.get-id').attr('id');
//     //             var formData = new FormData(form);
//     //             $.ajax({
//     //                 url: '/sections/'+ section + '/savestudent', type: 'POST', data: formData, processData: false, contentType: false,
//     //                 success: function(response) {
//     //                     var message;
//     //                     if (response.success) {
//     //                         message =  $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
//     //                         $('#student-form')[0].reset();

//     //                         // setTimeout(function(){
//     //                         //     window.location = "/sections/" + section;
//     //                         // }, 2000);
                            
//     //                     } else {
//     //                         message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');   
//     //                     }

//     //                     $('#container').append(message);

//     //                     setTimeout(function(){
//     //                         message.fadeOut('slow', function() {
//     //                             message.remove();
//     //                         });
//     //                     }, 3000);

//     //                     $saveBtn.text('Save');
//     //                 },
//     //                 error: function(jqXHR, textStatus, errorThrown) {
//     //                     console.log('Error:', errorThrown);
//     //                     $saveBtn.text('Save');
//     //                 }
//     //             });
//     //         }
//     //     });
//     // }

//     // if ($("#csv-form").length > 0) {
//     //     $("#csv-form").validate({
//     //         rules: {
//     //             csv: {
//     //                 required: true,
//     //                 accept: 'text/csv'
//     //             }
//     //         },
//     //         messages: {
//     //             csv: {
//     //                 required: 'Please select a file',
//     //                 accept: 'Only CSV files are allowed'
//     //             }
//     //         },

//     //         errorPlacement: function(error, element) {
//     //             error.appendTo(element.closest('form').find('span'));
//     //         },
//     //         success: function(label) {
//     //             label.closest('div').find('span').empty();
//     //         },

//     //         submitHandler: function(form) {
//     //             var $saveBtn = $('#csv-form button[type="submit"]');
//     //             $saveBtn.text('Uploading...');

//     //             $.ajaxSetup({
//     //                 headers: {
//     //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     //                 }
//     //             });

//     //             const section = $('.get-id').attr('id');
//     //             var formData = new FormData($("#csv-form")[0]);
//     //             $.ajax({
//     //                 url: '/sections/'+ section + '/importstudent', type: 'POST', data: formData, processData: false, contentType: false,
//     //                 success: function(response) {
//     //                     var message;
//     //                     if (response.success) {
//     //                         message =  $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');
//     //                         $('#csv-form')[0].reset();

//     //                         setTimeout(function(){
//     //                             window.location = "/sections/" + section;
//     //                         }, 1000);
                            
//     //                     } else {
//     //                         message = $('<div class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-20 py-3"><p class="poppins text-lg text-green-800 ">' + response.message + '</p></div>');   
//     //                     }

//     //                     $('#container').append(message);

//     //                     setTimeout(function(){
//     //                         message.fadeOut('slow', function() {
//     //                             message.remove();
//     //                         });
//     //                     }, 3000);

//     //                     $saveBtn.text('Upload');
//     //                 },
//     //                 error: function(jqXHR, textStatus, errorThrown) {
//     //                     console.log('Error:', errorThrown);
//     //                     $saveBtn.text('Upload');
//     //                 }
//     //             });
//     //         }
//     //     });
//     // }
// });