<x-guidance-layout>
    <div class="w-full h-full flex justify-center items-start p-4 bg-white text-gray-700">
        <div class="w-full flex flex-col md:flex-row md:space-x-4" >
            <div class="w-full md:w-1/2 " id="uploadFormWrapper">
                <form action="{{ route('calendar.store') }}" method="POST" enctype="multipart/form-data" class="flex flex-col space-y-4">
                    @csrf
                    <div class="flex flex-col space-y-2">
                        <h1 class="poppins text-lg font-medium">UPLOAD NEW CALENDAR</h1>
                        <div class="rounded shadow p-4 border border-gray-100">
                            <div class="flex flex-col space-y-1">
                                <label class="poppins text-sm font-semibold">
                                    Calendar
                                    @error('fileName')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </label>
                                <input class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem]
                                text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden
                                file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem]
                                file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px]
                                file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700
                                focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700
                                dark:file:text-neutral-100 dark:focus:border-primary"
                                type="file"
                                name="fileName"
                                accept=".pdf">
                                <div class="pt-4">
                                    <button class="px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded cursor-pointer">
                                        Upload
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="w-full md:w-1/2 flex flex-col py-4 h-[630px] overflow-y-auto">
                <div class="flex flex-col space-y-2">
                    <h1 class="poppins text-lg font-medium">RECENT CALENDARS</h1>
                    <div class="flex flex-col space-y-2">
                        @foreach ($calendars as $calendar)
                            <div class="border border-gray-100 bg-base-100 rounded-md shadow bg-white">
                                <div class="p-4 flex justify-between items-start bg-gray-200 rounded-t-md">
                                    <p class="poppins font-medium">{{ $calendar->name}}</p>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('calendar.edit', $calendar->id) }}">
                                            <i class='bx bx-edit text-sm text-blue-600'></i>
                                        </a>
                                        <form method="POST" action="{{ route('calendar.delete', $calendar->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button>
                                                <i class='bx bx-trash text-sm text-red-600'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <div class="p-2 px-4 border-t border-gray-200 bg-white">
                                    <a href="{{ route('calendar.view', $calendar->id) }}" target="_blank"
                                        class="poppins text-sm text-blue-600 hover:underline">
                                        {{substr($calendar->fileName, 0, 30)}}{{ strlen($calendar->fileName) > 45 ? "..." : "" }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guidance-layout>
