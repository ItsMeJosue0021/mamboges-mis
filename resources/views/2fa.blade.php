<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('image/mambog.png') }}" />
    <title>Mambog Elementary School</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="w-full h-screen container mx-auto text-gray-700 bg-white poppins">
        <div class="h-full w-full flex items-center justify-center">
            <div class="w-full md:w-96">
                <div class="bg-white flex flex-col items-center justify-center">
                    <div class="text-blue-600 font-semibold text-2xl p-2">Please verify that it's you</div>

                    <div class="p-4">
                        <form method="POST" action="{{ route('2fa.post') }}"
                            class="flex flex-col items-center justify-center">
                            @csrf

                            <p class="text-center text-sm">We sent code to email :
                                {{ substr(auth()->user()->email, 0, 5) . '******' . substr(auth()->user()->email, -2) }}
                            </p>

                            <div class="w-full flex flex-col mb-4 pt-4">
                                <input id="code" type="number"
                                    class="border w-full border-gray-300  text-sm px-4 p-2 mt-1 focus:outline-none rounded focus:border-blue-300 @error('code') border-red-500 @enderror"
                                    name="code" value="{{ old('code') }}" required autocomplete="code" autofocus
                                    placeholder="Your Code">

                                @error('code')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex flex-col items-center mb-2">
                                <div class="">
                                    <a id="resendButton" class="text-blue-500 hover:underline text-sm"
                                        href="{{ route('2fa.resend') }}">Resend Code?</a>
                                </div>
                                <span id="timerDisplay" class="py-1 text-base"></span>
                            </div>

                            <div class="w-full flex items-center justify-center mb-0">
                                <div class="w-full flex items-center justify-center">
                                    <button type="submit"
                                        class="w-[150px] bg-blue-600 text-sm hover:bg-blue-700 text-white px-4 py-2 rounded">
                                        Verify
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Set the duration of the timer in seconds
        var duration = 60;
        var timerDisplay = document.getElementById('timerDisplay');
        var timer = localStorage.getItem('timer') || duration;
        var minutes, seconds;

        function updateTimer() {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);

            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;

            timerDisplay.textContent = minutes + ":" + seconds;

            if (--timer < 0) {
                // Timer has reached 0, you can perform any action here
                // For example, disable the form submission or show a message
                timerDisplay.textContent = "Time's up!";
            }

            // Save the remaining time in local storage
            localStorage.setItem('timer', timer);
        }

        // Set the interval to update the timer every second
        var intervalId = setInterval(updateTimer, 1000);

        // Optionally, you can stop the timer on form submission
        document.querySelector('form').addEventListener('submit', function () {
            clearInterval(intervalId);
            // Clear the stored timer value when the form is submitted
            localStorage.removeItem('timer');
        });

        // Optionally, you can clear the stored timer value when the page is reloaded
        window.addEventListener('beforeunload', function () {
            localStorage.removeItem('timer');
        });
    });

</script> --}}

    <!-- Your HTML code remains unchanged -->

    <!-- Your HTML code remains unchanged -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set the duration of the timer in seconds
            var duration = 60;
            var timerDisplay = document.getElementById('timerDisplay');
            var resendButton = document.getElementById('resendButton');
            var timer = localStorage.getItem('timer') || duration;
            var minutes, seconds;

            function updateTimer() {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                timerDisplay.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    // Timer has reached 0, you can perform any action here
                    // For example, disable the form submission or show a message
                    timerDisplay.textContent = "Time's up!";
                }

                // Save the remaining time in local storage
                localStorage.setItem('timer', timer);
            }

            // Set the interval to update the timer every second
            var intervalId = setInterval(updateTimer, 1000);

            // Optionally, you can stop the timer on form submission
            document.querySelector('form').addEventListener('submit', function() {
                clearInterval(intervalId);
                // Clear the stored timer value when the form is submitted
                localStorage.removeItem('timer');
            });

            // Optionally, you can clear the stored timer value when the page is reloaded
            window.addEventListener('beforeunload', function() {
                localStorage.removeItem('timer');
            });

            // Add event listener to the resend button
            resendButton.addEventListener('click', function() {
                setTimeout(function() {
                    timer = duration; // Restart the timer after a 5-second delay
                }, 5000);
            });
        });
    </script>

    <x-flash-messages />
</body>

</html>
