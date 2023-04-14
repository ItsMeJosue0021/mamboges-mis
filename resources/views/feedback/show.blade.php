<x-guidance-layout>

    @if (session('success'))
        <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-green-100 px-48 py-3">
            <p class="poppins text-lg text-green-800 ">{{session('success')}}</p>
        </div>
    @endif

    @if (session('error'))
        <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="fixed top-3 rounded left-1/2 transform -translate-x-1/2 bg-red-100 px-48 py-3">
            <p class="poppins text-lg text-red-800 ">{{session('error')}}</p>
        </div>
    @endif

    <div class="py-2 pt-4 px-8">
        <a class="flex w-fit justify-start items-center space-x-2 group rounded" href="/feedback">
            <i class='bx bx-left-arrow-alt text-gray-600 text-2xl group-hover:text-red-700'></i>
            <p class="poppins text-base text-gray-600 group-hover:text-red-700">back</p>
        </a>
    </div>

    <div class="w-full h-600px flex flex-col py-4 px-8 overflow-y-auto">
        <div class="w-full flex items-center justify-between pb-4 border-b border-gray-300 mb-5">
            <div class="flex items-center space-x-4">
                <div class="bg-gray-400 rounded-full p-2 px-3">
                    <i class='bx bxs-user text-3xl text-gray-100'></i>
                </div>
                <div class="flex flex-col">
                    <h1 class="poppins text-xl font-medium text-gray-800 ">{{$feedback->name}}</h1>
                    <h2 class="poppins text-sm text-blue-500 hover:underline cursor-pointer">{{$feedback->email}}</h2>
                </div>
            </div>
            <div class="">
                <p class="poppins text-sm text-gray-600">{{$feedback->created_at}}</p>
            </div>
        </div>

        <div class="">
            <p class="poppins text-justify p-4">{{$feedback->message}}</p>
        </div>

        <div class="w-full flex flex-col py-4">
            <div>
                <button id="replyBtn" class="poppins text-white text-base bg-blue-500 py-2 px-6 rounded hover:bg-red-600">Reply</button>
            </div>

            <form id="replyForm" method="POST" action="/feedback/{{$feedback->id}}/replyfeedback" class="rounded-md shadow-EmailForm mt-8 p-4 hidden">
                @method('POST')
                @csrf
                <div class="flex flex-col space-y-3 mb-2">
                    <div class="flex items-center space-x-4">
                        <i class='bx bx-reply text-xl text-gray-500'></i>
                        <h2 class="poppins text-sm text-gray-500 hover:underline cursor-pointer">{{$feedback->email}}</h2>
                    </div>

                    <div class="w-full flex items-end space-x-4 border-b border-gray-300 focus-within:border-gray-500 py-1">
                        <input type="text" name="subject" id="subject" placeholder="Subject" 
                        class="w-full poppins text-sm text-gray-700 focus:outline-none">
                    </div>

                    <div class="flex h-60 w-full  ">
                        <textarea name="message" id="message" cols="30" rows="10"
                        class="w-full h-full p-4 poppins text-sm focus:outline-none rounded-md border border-gray-300 focus:border-gray-500"
                        placeholder="Your message here"></textarea>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button class="poppins text-white text-sm bg-blue-500 py-2 px-6 rounded hover:bg-red-600 border-2 border-blue-500 hover:border-red-600">Send</button>
                        <button id="cancel" class="poppins text-gray-400 text-sm py-2 px-6 rounded border-2 border-gray-300 hover:border-red-500 hover:text-red-500">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guidance-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#replyForm').hide();
        
        $('#replyBtn').click(function() {
            $('#replyForm').toggle();
            $('#replyBtn').hide();
        });

        $('#cancel').click(function() {
            event.preventDefault();
            $('#replyForm').hide();
            $('#replyBtn').show();
        });
    });

</script>