<x-guidance-layout>
    <section>
        <div class="p-4 flex flex-col space-y-2">
            <div class="flex flex-col space-y-2">
                <a id="back" class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group" href="/classes">
                    <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                    <p class="poppins text-sm text-black">Back</p>
                </a>
                <p class="text-sm text-blue-600 poppins">You're about to create an update.</p>
            </div>
            <form action="">
                <div class="flex items-start space-x-4 ">
                    <div class="w-3/4 h-96 flex flex-col space-y-2">
                        <div class="w-full flex items-center justify-between space-x-4">
                            <div class="flex flex-col space-y-1 w-full">
                                <label for="title" class="poppins text-sm font-semibold">TITLE</label>
                                <input name="title" id="title" type="text" placeholder="Title here.."
                                class="text-sm rounded border-2 border-gray-200">
                            </div>
                            <div class="flex flex-col space-y-1">
                                <label for="tag" class="poppins text-sm font-semibold">TAG</label>
                                <select name="tag" id="tag" class="text-sm rounded border-2 border-gray-200">
                                    @foreach ($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->tag}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label class="poppins text-sm font-semibold">DESCRIPTION</label>
                            <x-forms.tinymce-editor/>
                        </div>
                        <div class="pt-4">
                            <button type="submit" class="poppins text-sm text-white px-6 py-2 rounded bg-blue-700">POST</button>
                        </div>
                    </div>
                    <div class="w-1/4 h-96 border border-gray-300">

                    </div>
                </div>
            </form>
        </div>
    </section>

</x-guidance-layout>





    {{-- <div id="errormessage" class="h-700p w-full flex flex-col">
        <div class="py-2 pt-4 px-8">
            <a class="flex w-fit justify-start items-center space-x-2 group rounded" href="/updates/list">
                <i class='bx bx-left-arrow-alt text-gray-600 text-2xl group-hover:text-red-700'></i>
                <p class="poppins text-base text-gray-600 group-hover:text-red-700">back</p>
            </a>
        </div>
        <form id="updates-form" method="POST" action="javascript:void(0)" class="h-full w-full flex flex-col px-8 relative" enctype="multipart/form-data">
            @csrf
            <div class="flex h-full w-full items-start space-x-4 py-2">
                <div class="w-1/2 flex flex-col ">
                    <div id="photo-preview" class="h-400px flex items-center justify-center bg-gray-100 bg-cover bg-center rounded shadow-md">
                        <p class="poppins text-3xl text-gray-400 font-semibold">Upload a photo</p>
                    </div>
                    <div class="relative py-4">
                        <label>
                            <input multiple name="image" type="file" id="photo-input" class="poppins text-sm mr-2
                            file:mr-5 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-medium
                            file:bg-gray-100 file:text-gray-600 file:border-gray-400
                            hover:file:cursor-pointer hover:file:bg-red-100
                            hover:file:text-red-600" />
                        </label>
                        <span class="error poppins text-red-500 text-sm"></span>
                    </div>

                    <div class="w-full flex space-x-4 items-center py-4">
                        <button type="submit" class="poppins text-base text-white bg-blue-600 hover:bg-blue-700 border border-blue-600 hover:border-blue-700 py-2 px-10 rounded">Post</button>
                        <a href="/updates/list" class="poppins py-2 px-6 text-base text-gray-600 border border-gray-400 hover:border-red-400 hover:text-red-400 rounded">Cancel</a>
                    </div>
                </div>
                <div class="w-1/2 flex flex-col space-y-4">
                    <div class="flex flex-col">
                        <div class="flex items-center space-x-2">
                            <label class="poppins text-base text-gray-700 font-semibold" for="title">Tile</label>
                            <span class="error poppins text-red-500 text-sm"></span>
                        </div>
                        <input id="title" name="title" class="poppins text-sm py-2 px-4 border rounded focus:outline-none border-gray-400 focus:border-gray-600" type="text" placeholder="Type the title here">
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center space-x-2">
                            <label class="poppins text-base text-gray-700 font-semibold" for="title">Tags</label>
                            <span class="error poppins text-red-500 text-sm"></span>
                        </div>
                        <input id="tag" name="tag" class="poppins text-sm py-2 px-4 border rounded focus:outline-none border-gray-400 focus:border-gray-600" type="text" placeholder="Type the title here">
                    </div>
                    <div class="flex flex-col h-96">
                        <div class="flex items-center space-x-2">
                            <label class="poppins text-base text-gray-700 font-semibold py-2" for="description">Description</label>
                            <span class="error poppins text-red-500 text-sm"></span>
                        </div>
                        <textarea id="description" name="description" class="h-400px poppins text-sm py-2 px-4 border rounded focus:outline-none border-gray-400 focus:border-gray-600" type="text" placeholder="Type the description here"></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('js/update_create.js') }}"></script> --}}

  