<x-guidance-layout>
    <section class="border-b rounded px-4">
        <div class="flex items-center justify-between py-4">
            <div class="hidden md:flex border-l-4 border-red-400 py-1 px-2">
                <h1 class="poppins text-2xl font-medium">FEEDBACK</h1>
            </div>
            <div class="w-full md:w-1/2 flex ">
                <form action="/feedback" class="flex w-full justify-between space-x-4">
                    <input name="search" type="text" placeholder="Type here.."
                        class="w-full poppins text-sm focus:outline-none focus:bg-gray-100 border-gray-300 py-2 px-4 rounded">
                    <button type="submit"
                        class="poppins text-sm text-white bg-blue-500 hover:bg-blue-600 rounded py-2 px-6">Search</button>
                </form>
            </div>
        </div>
    </section>
    <section class="h-580px w-full text-gray-600 body-font overflow-y-auto scrollbar-thin">
        <div class="px-4 py-2">
            @if (count($feedbacks) == 0)
                <div class="w-full h-96 flex flex-col items-center justify-center mt-20">
                    <img class="h-60 w-60" src="{{ asset('image/search.png') }}" alt="">
                    <p class="poppins text-xl  text-red-500 mt-5">Oops! No result found.</p>
                    <a class="poppins text-xm text-blue-500 underline" href="/feedback">refresh</a>
                </div>
            @endif
            @foreach ($feedbacks as $feedback)
                <x-feedback-card :feedback="$feedback" />
            @endforeach
        </div>
    </section>
</x-guidance-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.feedback-container').click(function(event) {
            window.location.href = $(this).attr('href');
            event.preventDefault();
            const feedbackId = $(this).data('feedback-id');
            const url = `/feedback/${feedbackId}/read`;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: url,
                type: 'PUT',
                success: function() {},
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });
</script>
