<div class="w-full flex items-center justify-between border border-gray-200 shadow-md rounded py-2 px-2 mb-3">
    <div class="w-full flex items-center space-x-4 rounded">
        <div class="w-fit flex items-center space-x-4">
            <h1 class="poppins h-full rounded p-2 text-sm font-bold">PERFORMANCE TASK</h1>

            <div class="flex items-center space-x-2">
                <form id="PT_percentageForm"  method="POST" action="javascript::void(0)" class="flex items-center rounded py-2 px-2 border border-gray-300">
                    @csrf
                    @method('PUT')
                    <h2 class="poppins text-sm mr-3">PERCENTAGE</h2>
                    <input id="percentageInput" name="percentage" class="w-10 py-1 mr-2 text-center px-1 poppins text-xs rounded border border-gray-300 focus:outline-none" type="number" placeholder="0" max="100" min="0">
                    <button id="PT_changePercentageButton" data-evaluation-id="{{ $evaluations->skip(1)->first()->id }}"  class="poppins text-xs text-white bg-blue-800 hover:bg-[#004080] px-2 py-1 font-bold rounded">CHANGE</button>
                </form>
            </div>
        </div>

        <div class="w-fit flex items-center space-x-3 rounded py-2 px-2 border border-gray-300">
            <p class="poppins py-1 px-3 rounded border border-gray-300 text-xs">10</p>
            <h2 class="poppins text-sm ">ACTIVITIES</h2>
            <a id="new-pt-act" class="poppins text-xs font-bold text-white bg-green-800 px-2 py-1 rounded cursor-pointer">NEW</a>
        </div>
    </div>

</div>

<script type="module">
    $(document).ready(function() {

        $("#percentageInput").on("input", function() {
            var min = parseFloat($(this).attr("min"));
            var max = parseFloat($(this).attr("max"));
            var value = parseFloat($(this).val());

            if (isNaN(value)) {
                $(this).val(min);
            } else if (value < min) {
                $(this).val(min);
            } else if (value > max) {
                $(this).val(max);
            }
        });

        $("#PT_changePercentageButton").click(function(e) {
            e.preventDefault(); 
    
            var form = $('#PT_percentageForm'); 
            var evaluationId = $(this).data("evaluation-id");
            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajaxSetup({ headers: {'X-CSRF-TOKEN': csrfToken} });
    
            $.ajax({
                type: "POST",
                url: '/update-percentage/' + evaluationId,
                data: form.serialize(), 
                success: function(response) {
                    var message;
                    if (response.status === 'success') {
                        message =  $('<div class="fixed top-5 left-1/2 bg-green-700 text-white transform -translate-x-1/2 px-10 py-3 text-medium rounded shadow-xl z-20">' + response.message + '</p></div>');
                        $('#PT_percentageForm')[0].reset();
                        getPercentage(evaluationId);
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
                    console.error(error);
                }
            });

        });

        function getPercentage(criteria) {
            $.ajax({
                type: "GET",
                url: '/get-percentage/' + criteria,
                success: function(response) {
                    if (response.status === 'success') {
                        $('#percentageValue_1').text(response.percentage + '%');
                        $('.percentageValue').text(response.percentage + '%');
                    } else {
                        console.error(response.error);
                    }
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    });
</script>