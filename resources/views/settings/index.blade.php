<x-guidance-layout>
    <div id="container" class="w-full relative">
        <div class="flex flex-col p-4">
            <div class="py-2">
                <a id="back" class="flex w-fit justify-start items-center space-x-2 group rounded cursor-pointer" href="/settings">
                    <i class='bx bx-left-arrow-alt text-gray-600 text-2xl group-hover:text-red-700'></i>
                    <p class="poppins text-base text-gray-600 group-hover:text-red-700">back</p>
                </a>
            </div>

            <div class="w-full">
                <div class="w-full flex flex-col items-center justify-center">

                    <div class="w-fit flex flex-col p-4 rounded-md shadow border border-gray-200">
                        <div class="w-700px flex flex-col space-y-6">
                            <div class="flex flex-col space-y-4">
                                <div>
                                    <h1 class="poppins text-lg text-gray-800 font-semibold">CURRENT SCHOOL YEAR</h1>
                                </div>

                                <form method="POST" action="/schoolyears/change" id="change-sy-form" class="flex flex-col space-y-1">
                                    @csrf
                                    @method('PUT')
                                    <div class="flex items-baseline space-x-2">
                                        <h1 class="poppins text-sm text-blue-400">CHANGE SCHOOL YEAR</h1>
                                        <span class="error text-xs text-red-600"></span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <select name="new_school_year" id="new_school_year"
                                        class="w-full poppins text-gray-800 border border-gray-300 rounded py-2 px-2">

                                        </select>
                                        <div>
                                            <button type="submit" class="poppins text-white bg-blue-500 rounded py-2 px-3">change</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="w-full border-t border-gray-300 pt-4 mt-6 space-y-4">
                                <div>
                                    <h1 class="poppins text-lg text-gray-800 font-semibold">ADD NEW SCHOOL YEAR</h1>
                                </div>
                                <form method="POST" action="/schoolyears/new" id="add-newSY-form" class="w-full flex items-end justify-between">
                                    @csrf
                                    <div class="flex flex-col space-y-1 justify-end">
                                        <div  class="flex items-baseline space-x-2">
                                            <label for="name" class="poppins text-sm">SCHOOL YEAR</label>
                                            <span class="error text-xs text-red-600"></span>
                                        </div>
                                        <input type="text" name="name" id="name" class="w-full poppins text-gray-800 border border-gray-300 rounded py-2 px-2" placeholder="ex. 2022-2023">
                                    </div>

                                    <div class="flex flex-col space-y-1">
                                        <div  class="flex items-baseline space-x-2">
                                            <label for="start_date" class="poppins text-sm">START DATE</label>
                                            <span class="error text-xs text-red-600"></span>
                                        </div>
                                        <input type="date" name="start_date" id="start_date" class="w-full poppins text-gray-800 border border-gray-300 rounded py-2 px-2" placeholder="ex. 2022-2023">
                                    </div>

                                    <div class="flex flex-col space-y-1 justify-end">
                                        <div  class="flex items-baseline space-x-2">
                                            <label for="end_date" class="poppins text-sm">END DATE</label>
                                            <span class="error text-xs text-red-600"></span>
                                        </div>
                                        <input type="date" name="end_date" id="end_date" class="w-full poppins text-gray-800 border border-gray-300 rounded py-2 px-2" placeholder="ex. 2022-2023">
                                    </div>

                                    <div class="flex items-center">
                                        <button type="submit" class="poppins text-white bg-blue-500 border border-blue-500 rounded py-2 px-6">add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guidance-layout>
<script type="module" src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script type="module" src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="module" src="{{ asset('js/settings_index.js') }}"></script>
