<x-lr-layout>
    <div class="flex w-full flex-col space-y-4">
        <div class="flex flex-col space-y-2 pb-3">
            <a href="{{ route('lr.module') }}" id="back"
                class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group">
                <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                <p class="poppins text-sm text-black">Back</p>
            </a>
        </div>
        <form action="{{ route('module.update', $module->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="w-full flex items-start justify-center">
                <div class="w-full md:w-2/3">
                    <div class="w-full flex flex-col space-y-4">
                        <div class="flex flex-col md:flex-row items-start space-y-4 md:space-y-0 md:space-x-4">
                            <div class="flex flex-col space-y-1 items-start justify-start w-full">
                                <label for="tag" class="poppins text-sm font-semibold">COVER PHOTO
                                    @error('thumbnail')
                                        <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                    @enderror
                                </label>
                                <label for="dropzone-file"
                                    class="flex flex-col items-center justify-center w-full h-72 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div id="description" class="hidden flex flex-col items-center justify-center pt-5 pb-6">
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
                                        <img id="db-cover-photo" src="{{ asset('storage/' . $module->thumbnail) }}"
                                         class="w-full h-full rounded-md object-cover object-top" />
                                    <input id="dropzone-file" type="file" name="thumbnail" class="hidden"
                                        accept="image/png, image/jpeg, image/gif" onchange="previewCoverPhoto(this)" />
                                </label>

                                <script>
                                    function previewCoverPhoto(input) {
                                        var imagePreview = document.getElementById('image-preview');
                                        var description = document.getElementById('description');
                                        var dbCoverPhoto = document.getElementById('db-cover-photo');

                                        if (input.files && input.files[0]) {
                                            var reader = new FileReader();

                                            reader.onload = function(e) {
                                                imagePreview.src = e.target.result;
                                                imagePreview.classList.remove('hidden');
                                                description.classList.add('hidden');
                                                dbCoverPhoto.classList.add('hidden');
                                            };

                                            reader.readAsDataURL(input.files[0]);
                                        } else {
                                            imagePreview.src = '';
                                            imagePreview.classList.add('hidden');
                                            description.classList.add('hidden');
                                            dbCoverPhoto.classList.add('hidden');
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
                                    <input type="text" name="title" id="title" placeholder="Title" value="{{ $module->title }}"
                                        class="poppins rounded border-2 border-gray-300 text-sm">
                                </div>
                                <div class="w-full flex flex-col space-y-1">
                                    <label class="poppins text-sm font-semibold">GRADE</label>
                                    <select name="grade" id="grade"
                                        class="poppins rounded border-2 border-gray-300 text-sm">
                                        <option value="Kinder" {{ $module->grade == 'Kinder' ? 'selected' : '' }}>Kinder</option>
                                        <option value="1" {{ $module->grade == '1' ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ $module->grade == '2' ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ $module->grade == '3' ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ $module->grade == '4' ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ $module->grade == '5' ? 'selected' : '' }}>5</option>
                                        <option value="6" {{ $module->grade == '6' ? 'selected' : '' }}>6</option>
                                    </select>
                                </div>

                                <div class="w-full flex flex-col space-y-1">
                                    <label class="poppins text-sm font-semibold">TOPIC</label>
                                    <select name="topic" id="topic"
                                        class="poppins rounded border-2 border-gray-300 text-sm">
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}"
                                                {{ $module->topic == $subject->id ? 'selected' : '' }}>
                                                {{ $subject->name }}</option>
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
                                    <input value="{{ $module->file }}"
                                        class="poppins relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem]
                                        text-sm font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden
                                        file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem]
                                        file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px]
                                        file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700
                                        focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700
                                        dark:file:text-neutral-100 dark:focus:border-primary"
                                        type="file" name="file" accept=".pdf">
                                        <div class="flex space-x-2 py-1">
                                            <span class="poppins text-xs font-bold">Current File:</span>
                                            <a href="{{ route('module.view', [$module->id, $module->title]) }}" target="_blank" class="poppins text-xs text-blue-600 hover:underline">
                                                {!! substr($module->title, 0, 20) !!}{{ strlen($module->title) > 20 ? '...' : '' }}
                                            </a>
                                        </div>

                                </div>
                            </div>
                        </div>

                        <div class="w-full">
                            <label class="poppins text-sm font-semibold">DESCRIPTION
                                @error('description')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </label>
                            <textarea name="description" id="myeditorinstance" placeholder="Write something..">
                                {{ $module->description }}
                            </textarea>
                        </div>
                        <div class="flexn">
                            <button
                                class="poppins text-base w-full py-2 rounded bg-blue-700 hover:bg-blue-800 text-white">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
