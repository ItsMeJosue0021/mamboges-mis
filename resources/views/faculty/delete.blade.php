<x-guidance-layout>
    <div class="p-4">
        <div class="flex flex-col space-y-2 mb-3">
            <a href="{{ route('faculties.show', $faculty->id) }}" id="back"
                class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group">
                <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                <p class="poppins text-sm text-black">Back</p>
            </a>
        </div>
        <div class="w-full flex items-start justify-center">
            <form action="{{ route('faculties.delete', $faculty->id) }}" method="POST"
                class="w-1/2 rounded-md p-4 border border-gray-200 shadow">
                @csrf
                <div class="flex flex-col ">
                    <div class="mb-2">
                        <h1 class="poppins text-lg font-medium border-b border-gary-300 mb-2 text-red-500">You Are About
                            To Remove A Faculty</h1>
                        <p class="poppins text-sm text-left text-gray-600">The Faculty will be removed from the list of
                            active students but will not be
                            permanently deleted.</p>
                    </div>
                    <div>
                        <div class="flex flex-col space-y-2">
                            <label for="radioOption" class="poppins ">Reason of Deletion:</label>
                            <div class="flex items-center space-x-2">
                                <input type="radio" id="radioOption" name="reason" value="No Longer Participating">
                                <label class="text-sm poppins">No Longer Participating</label>
                            </div>

                            <div class="flex items-center space-x-2">
                                <input type="radio" id="radioOption2" name="reason"
                                    value="Transfered To Another School">
                                <label class="text-sm poppins">Transfered To Another School</label>
                            </div>

                            <div class="flex items-center space-x-2">
                                <input type="radio" id="other">
                                <label class="text-sm poppins">Other</label>
                            </div>


                            <div id="otherReason" class="hidden flex-col space-y-1">
                                
                            </div>

                            <div class="flex items-center space-x-3 pt-3">
                                <button class="px-4 py-2 rounded text-sm poppins bg-blue-600 text-white">Submit</button>
                                <a href="{{ route('faculties.index') }}"
                                    class="poppis text-sm py-2 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const otherRadio = document.getElementById("other");
            const otherReasonDiv = document.getElementById("otherReason");
            const radioOptions = document.querySelectorAll("input[type='radio'][name='reason']");

            otherRadio.addEventListener("click", function() {
                if (otherRadio.checked) {
                    otherReasonDiv.innerHTML = `
                        <span class="text-xs italic text-gray-600 poppins">Please specify the reason</span>
                        <input type="text" name="reason" placeholder="Type the reason here.."
                            class="poppins rounded text-sm border border-gray-300">
                    `;
                    otherReasonDiv.style.display = "flex";
                } else {
                    otherReasonDiv.innerHTML = "";
                    otherReasonDiv.style.display = "none";
                }

                radioOptions.forEach(function(radio) {
                    radio.checked = false;
                });
            });

            radioOptions.forEach(function(radio) {
                radio.addEventListener("click", function() {
                    if (radio !== otherRadio && otherRadio.checked) {
                        otherRadio.checked = false;
                        otherReasonDiv.innerHTML = "";
                        otherReasonDiv.style.display = "none";
                    }
                });
            });
        });
    </script>


</x-guidance-layout>
