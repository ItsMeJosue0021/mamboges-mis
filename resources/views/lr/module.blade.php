<x-lr-layout>
    <div class="flex w-full flex-col space-y-4">
        <div class="flex flex-col space-y-2 pb-3">
            <a href="{{ route('lr.module') }}" id="back"
                class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group">
                <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                <p class="poppins text-sm text-black">Back</p>
            </a>
        </div>

        <div class="w-full flex flex-col md:flex-row items-start md:space-x-4">
            <form action="{{ route('module.store') }}" method="POST" enctype="multipart/form-data" class="w-full">
                @csrf
                <div class="w-full flex flex-col space-y-4">
                    <div class="flex flex-col md:flex-row items-start space-y-4 md:space-y-0 md:space-x-4">
                        <div class="flex flex-col space-y-1 items-start justify-start w-full">
                            <label for="tag" class="poppins text-sm font-semibold">COVER PHOTO
                                @error('thumbnail')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </label>
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-72 border border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div id="description" class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Click
                                            to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or GIF</p>
                                </div>
                                <img id="image-preview" src="#" alt="Preview"
                                    class="hidden w-full h-full rounded-md" />
                                <input id="dropzone-file" type="file" name="thumbnail" class="hidden"
                                    accept="image/png, image/jpeg, image/gif" onchange="previewCoverPhoto(this)" />
                            </label>

                            <script>
                                function previewCoverPhoto(input) {
                                    var imagePreview = document.getElementById('image-preview');
                                    var description = document.getElementById('description');

                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function(e) {
                                            imagePreview.src = e.target.result;
                                            imagePreview.classList.remove('hidden');
                                            description.classList.add('hidden');
                                        };

                                        reader.readAsDataURL(input.files[0]);
                                    } else {
                                        imagePreview.src = '';
                                        imagePreview.classList.add('hidden');
                                        description.classList.remove('hidden');
                                    }
                                }
                            </script>
                        </div>
                        <div class="w-full flex flex-col space-y-4">
                            <div class="w-full flex flex-col space-y-1">
                                <label class="poppins text-sm font-semibold">TITLE
                                    @error('title')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </label>
                                <input type="text" name="title" id="title" placeholder="Title"
                                    class="poppins rounded border border-gray-300 text-sm">
                            </div>
                            <div class="w-full flex flex-col space-y-1">
                                <label class="poppins text-sm font-semibold">GRADE</label>
                                <select name="grade" id="grade"
                                    class="poppins rounded border border-gray-300 text-sm">
                                    <option value="Kinder">Kinder</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div>

                            <div class="w-full flex flex-col space-y-1">
                                <label class="poppins text-sm font-semibold">TOPIC</label>
                                <select name="topic" id="topic"
                                    class="poppins rounded border border-gray-300 text-sm">
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col space-y-1">
                                <label class="poppins text-sm font-semibold">
                                    MODULE
                                    @error('file')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </label>
                                <input
                                    class="poppins relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem]
                                text-sm font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden
                                file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem]
                                file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px]
                                file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700
                                focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700
                                dark:file:text-neutral-100 dark:focus:border-primary"
                                    type="file" name="file" accept=".pdf">
                            </div>
                        </div>
                    </div>

                    <div class="w-full">
                        <label class="poppins text-sm font-semibold">DESCRIPTION
                            @error('description')
                                <span class="text-xs font-light text-red-600">{{ $message }}</span>
                            @enderror
                        </label>
                        <x-forms.tinymce-editor />
                    </div>
                    <div class="flexn">
                        <button
                            class="poppins text-base w-full py-2 rounded bg-blue-700 hover:bg-blue-800 text-white">Upload</button>
                    </div>
                </div>
            </form>

            <div class="w-full hidden md:block">
                <h1 class="poppins text-2xl font-medium pb-3">Current Modules</h1>
                <div class="flex flex-col space-y-3">
                    @foreach ($modules as $module)
                    <div
                    class="relative w-full p-2 rounded bg-white hover:shadow transition-all ease-in-out duration-200 flex items-center justify-between border border-gray-200">
                    <div class="w-full flex flex-row items-center space-x-4">
                        <img src="{{ $module->thumbnail ? asset('storage/' . $module->thumbnail) : ''}}"
                            class="w-16 h-16 rounded object-cover">
                        <div class="w-full flex flex-col">
                            <h1 class="hidden md:block poppins text-sm text-black font-semibold">
                                {!! substr($module->title, 0, 70) !!}{{ strlen($module->title) > 70 ? '...' : '' }}
                            </h1>
                            <h1 class="md:hidden poppins text-sm text-black font-semibold">
                                {!! substr($module->title, 0, 20) !!}{{ strlen($module->title) > 20 ? '...' : '' }}
                            </h1>
                            <div class="flex items-center space-x-4">
                                @php
                                    $subject = App\Models\Subjects::find($module->topic);
                                @endphp
                                <span class="poppins text-xs text-green-600">{{ $subject->name }}</span>
                                <span class="poppins text-xs text-blue-500">
                                    @if ($module->grade == 'Kinder')
                                        {{ $module->grade }}
                                    @else
                                        Grade {{$module->grade}}
                                    @endif
                                </span>
                            </div>
                            <p class="poppins text-sm text-gray-600">
                                {!! substr($module->description, 0, 45) !!}{{ strlen($module->description) > 45 ? '...' : '' }}</p>
                            <a href="{{ route('module.view', [$module->id, $module->title]) }}" target="_blank"
                                class="w-fit text-xs underline poppins text-blue-600 hover:underline text-center">Open</a>
                        </div>
                    </div>
                    <div class="absolute top-1 right-4 md:flex flex-col items-center space-y-2 z-10 bg-white bg-opacity-50 p-2 rounded-md">
                        <a href="{{ route('module.edit', $module->id) }}">
                            <i class='bx bx-edit text-sm text-blue-600'></i>
                        </a>
                        <form action="{{ route('module.delete', $module->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button>
                                <i class='bx bx-trash text-sm text-red-600'></i>
                            </button>
                        </form>
                    </div>
                </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-lr-layout>

<script>
    function handleVideoPreview() {
        const fileInput = event.target;
        const videoPreview = document.getElementById('video-preview');
        const description = document.getElementById('description');
        const uploadBtn = document.getElementById('upload');

        if (fileInput.files.length > 0) {
            const videoFile = fileInput.files[0];
            const videoURL = URL.createObjectURL(videoFile);

            videoPreview.src = videoURL;
            videoPreview.classList.remove('hidden');
            description.classList.add('hidden');
            uploadBtn.classList.replace('hidden', 'flex');
        }
    }
    document.getElementById('dropzone-file').addEventListener('change', handleVideoPreview);
</script>
