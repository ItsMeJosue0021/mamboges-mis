<div class="w-full flex items-center justify-between border border-gray-100 shadow-md rounded py-2 px-2 mb-3">
    <div class="w-full flex items-center space-x-4 rounded">
        <div class="w-fit flex items-center space-x-4">
            <h1 class="poppins h-full rounded p-2 text-sm font-bold">WRITTEN WORKS {{ $evaluations->first()->id }}</h1>

            <div class="flex items-center space-x-2">
                <form id="percentageForm"  method="POST" action="javascript::void(0)" class="flex items-center rounded py-2 px-2 border border-gray-300">
                    @csrf
                    @method('PUT')
                    <h2 class="poppins text-sm mr-3">PERCENTAGE</h2>
                    <input name="percentage" class="w-10 py-1 mr-2 text-center px-1 poppins text-xs rounded border border-gray-300 focus:outline-none" type="number" placeholder="20%">
                    <button id="changePercentageButton" data-evaluation-id="{{ $evaluations->first()->id }}"  class="poppins text-xs text-white bg-blue-800 hover:bg-[#004080] px-2 py-1 font-bold rounded">CHANGE</button>
                </form>
            </div>
        </div>

        <div class="w-fit flex items-center space-x-4 rounded py-2 px-2 border border-gray-300">
            <h2 class="poppins text-sm ">ACTIVITIES</h2>
            <p class="poppins py-1 px-3 rounded border border-gray-300 text-xs">10</p>
            <a id="new-written-act" class="poppins text-xs font-bold text-white bg-[#007A5E] px-2 py-1 rounded cursor-pointer">NEW</a>
        </div>
    </div>

    <div class="w-full justify-end flex items-center">
        <button type="submit" class="poppins text-sm text-white bg-blue-800 hover:bg-[#004080] border border-[#004080] py-2 px-6 rounded">Save</button>
    </div>
</div>

<script type="module">
    $(document).ready(function() {
        $("#changePercentageButton").click(function(e) {
            e.preventDefault(); 
    
            var form = $('#percentageForm'); 
            var evaluationId = form.data("evaluation-id");
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
    
            $.ajax({
                type: "PUT",
                url: '/update-percentage/1',
                data: form.serialize(), 
                success: function(response) {
                    var message;
                    if (response.success) {
                        message =  $('<div class="fixed top-5 left-1/2 bg-green-700 text-white transform -translate-x-1/2 px-10 py-3 text-medium rounded shadow-xl z-20">' + response.message + '</p></div>');
                        $('#percentageForm')[0].reset();
                        
                    } else {
                        message = $('<div class="fixed top-5 left-1/2 bg-red-700 text-white transform -translate-x-1/2 px-10 py-3 text-medium rounded shadow-xl z-20 ">' + response.message + '</p></div>');   
                    }

                    $('#container').append(message);

                    setTimeout(function(){
                        message.fadeOut('slow', function() {
                            message.remove();
                        });
                    }, 3000);
                },
                error: function(error) {
                    // Handle the error response here
                    console.error(error);
                }
            });
        });
    });
    </script>