<x-guidance-layout>
    <div class="w-full p-4">
        <div>
            <a class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group"
                href="{{ route('calendar.index') }}">
                <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                <p class="poppins text-sm text-black">Back</p>
            </a>
        </div>
        <div class="w-full flex justify-center items-start space-x-4" >
            <div class="w-full md:w-1/2 " id="uploadFormWrapper">
                <form action="{{ route('calendar.update', $calendar->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-col space-y-2 bg-white">
                        <h1 class="poppins text-lg font-medium">UPDATE CALENDAR</h1>
                        <div class="flex flex-col space-y-3 rounded shadow p-4 border border-gray-100">
                            <div class="flex flex-col space-y-1">
                                <label class="poppins text-sm font-semibold">
                                    Name
                                    @error('name')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </label>
                                <input name="name"  id="name" type="text" placeholder="Please provide a name.."
                                    class="poppins text-sm px-4 py-2 rounded border-2 border-gray-200"
                                    value="{{ old('name') ?? $calendar->name}}">
                            </div>
                            <div class="flex flex-col space-y-1 bg-white">
                                <label class="poppins text-sm font-semibold">
                                    Current Calendar
                                </label>
                                <a href="{{ route('calendar.view', $calendar->id) }}" target="_blank"
                                    class="poppins text-sm text-blue-600 hover:underline">
                                    {{substr($calendar->fileName, 0, 30)}}{{ strlen($calendar->fileName) > 45 ? "..." : "" }}
                                </a>
                            </div>
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
                                accept=".pdf"
                                value="{{ $calendar->fileName }}">+
                            </div>
                            <div class="pt-4">
                                <button class="px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded cursor-pointer">
                                    Update
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guidance-layout>
