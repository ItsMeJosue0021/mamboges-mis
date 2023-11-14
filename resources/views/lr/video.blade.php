<x-lr-layout>
    <div class="flex w-full flex-col space-y-4">
        <div class="flex items-center space-x-4">
            <a href="{{ route('lr.video') }}" class="poppins text-sm px-4 py-2 rounded-sm text-white bg-blue-700 hover:bg-blue-800">Video Lessons</a>
            <a href="{{ route('lr.module') }}" class="poppins text-sm px-4 py-2 rounded-sm bg-gray-200 hover:bg-gray-300">Modules</a>
        </div>
         <form action="{{ route('video-lessons.store') }}" method="POST" enctype="multipart/form-data" >
            @csrf
            <div class="w-full flex flex-col md:flex-row items-start md:space-x-4">
                <div class="w-full md:w-3/5">
                    <label for="dropzone-file" class="relative flex flex-col items-center justify-center w-full h-[450px] border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div id="description" class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Video</p>
                        </div>
                        <video id="video-preview" src="#" controls class="hidden w-full h-full rounded-md"></video>
                        <input id="dropzone-file" type="file" name="video" class="hidden" accept="video/*" />

                        <div id="upload" class="hidden absolute right-5 top-5 z-20 flex-col items-center justify-center p-3 rounded-full bg-gray-300 hover:bg-gray-500 group">
                            <svg class="w-6 h-6 text-gray-500 group-hover:text-white dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                        </div>
                    </label>

                    <div class="flex flex-col space-y-4 pt-4">
                        <div class="w-full flex flex-col space-y-1">
                            <label class="poppins text-sm font-semibold">TITLE</label>
                            <input type="text" name="title" id="title" class="poppins rounded-md border-2 border-gray-300 text-sm " placeholder="Title of the video">
                        </div>

                        <div class="hidden md:flex">
                            <button  class="poppins text-base px-6 py-2 rounded bg-blue-700 hover:bg-blue-800 text-white">Upload</button>
                        </div>
                    </div>
                </div>

                <div class="w-full md:w-2/5">
                    <div class="w-full flex flex-col space-y-4">
                        <div class="w-full flex space-x-4">
                            <div class="w-full flex flex-col space-y-1">
                                <label class="poppins text-sm font-semibold">GRADE</label>
                                <select name="grade" id="grade" class="poppins rounded-md border-2 border-gray-300 text-sm">
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
                                <select name="topic" id="topic" class="poppins rounded-md border-2 border-gray-300 text-sm">
                                    @foreach ($subjects as $subject)
                                        <option value="{{$subject->id}}">{{$subject->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="w-full">
                            <label class="poppins text-sm font-semibold">DESCRIPTION
                                @error('description')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </label>
                            <x-forms.tinymce-editor/>
                        </div>
                        <div class="flex md:hidden">
                            <button  class="poppins text-base w-full py-2 rounded bg-blue-700 hover:bg-blue-800 text-white">Upload</button>
                        </div>
                    </div>
                </div>


            </div>

        </form>

    </div>
</x-lr-layout>

<script>
    // Function to handle video preview
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
