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

    <div class="w-full p-4">
        <div class="flex flex-col space-y-2">
            <a href="{{ route('feedback.index') }}" id="back" class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group">
                <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                <p class="poppins text-sm text-black">Back</p>
            </a>
        </div>
    </div>

    <div class="w-full flex flex-col py-4 px-4 overflow-y-auto">
        <div class="w-full flex flex-col-reverse md:flex-row items-start md:items-center justify-start md:justify-between pb-4 border-b border-gray-300 mb-5">
            <div class="flex items-center space-x-4">
                <div class="bg-gray-400 rounded-full p-2 px-3">
                    <i class='bx bxs-user text-3xl text-gray-100'></i>
                </div>
                <div class="flex flex-col">
                    <h1 class="poppins text-xl font-medium text-gray-800 ">{{$feedback->name}}</h1>
                    <h2 class="poppins text-sm text-blue-500 hover:underline cursor-pointer">{{$feedback->email}}</h2>
                    <p class="md:hidden poppins text-sm text-gray-600 pt-1">{{$feedback->created_at}}</p>
                </div>
            </div>
            <div class="hidden md:flex">
                <p class="poppins text-sm text-gray-600">{{$feedback->created_at}}</p>
            </div>
        </div>

        <div class="">
            <p class="poppins text-justify py-4">{{$feedback->message}}</p>
        </div>

        <div class="w-full flex flex-col py-4">
            <div>
                <button id="replyBtn" class="poppins text-white text-sm bg-blue-600 py-2 px-6 rounded hover:bg-blue-700">Reply</button>
            </div>

            <form id="replyForm" method="POST" action="/feedback/{{$feedback->id}}/replyfeedback" class="rounded-md border border-gray-500 mt-8 p-4 hidden">
                @method('POST')
                @csrf
                <div class="flex flex-col space-y-3 mb-2">
                    <div class="flex items-center space-x-4">
                        <i class='bx bx-reply text-xl text-blue-700'></i>
                        <h2 class="poppins text-sm text-blue-700 hover:underline cursor-pointer">{{$feedback->email}}</h2>
                    </div>

                    <div class="w-full flex items-end space-x-4 focus-within:border-gray-400 py-1 \">
                        <input type="text" name="subject" id="subject" placeholder="Subject"
                        class="w-full poppins text-sm text-gray-700 rounded border border-gray-400 focus:outline-none">
                    </div>

                    <div class="flex h-60 w-full  ">
                        <textarea name="message" id="message" cols="30" rows="10"
                        class="w-full h-full p-4 poppins text-sm focus:outline-none rounded-md border border-gray-500 focus:border-gray-500"
                        placeholder="Your message here"></textarea>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button class="poppins text-white text-sm bg-blue-600 py-2 px-6 rounded hover:bg-blue-700 border-2 border-blue-600 hover:border-blue-700">Send</button>
                        <button id="cancel" class="poppins text-gray-400 text-sm py-2 px-6 rounded border border-gray-300 hover:border-gray-500 hover:text-gray-700">Cancel</button>
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
