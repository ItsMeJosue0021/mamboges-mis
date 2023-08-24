<x-guidance-layout>
    <div id="errormessage" class="h-700p w-full flex flex-col">
        <div class="py-2 pt-4 px-8">
            <a class="flex w-fit justify-start items-center space-x-2 group rounded" href="/updates/list">
                <i class='bx bx-left-arrow-alt text-gray-600 text-2xl group-hover:text-red-700'></i>
                <p class="poppins text-base text-gray-600 group-hover:text-red-700">back</p>
            </a>
        </div>
        <form id="updates-form" method="POST" action="javascript:void(0)" class="h-full w-full flex flex-col px-8 relative" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="get-id flex h-full w-full items-start space-x-4 py-2" id="{{$updates->id}}">
                <div class="w-1/2 flex flex-col ">
                    <div id="photo-preview" class="h-400px flex items-center justify-center bg-gray-100 bg-cover bg-center rounded shadow-md"
                        style="background-image: url('{{ asset('storage/' . $updates->image) }}')">
                        @if (!$updates->image)
                            <p class="poppins text-3xl text-gray-400 font-semibold">Upload a photo</p>
                        @endif
                    </div>
                    <div class="relative py-4">
                        <label>
                            <input name="image" type="file" id="photo-input" class="poppins text-sm mr-2
                            file:mr-5 file:py-2 file:px-4
                            file:rounded-md file:border-0
                            file:text-sm file:font-medium
                            file:bg-green-100 file:text-green-600
                            hover:file:cursor-pointer" 
                            value="{{$updates->image}}"/>
                        </label>
                        <span class="error poppins text-red-500 text-sm"></span>
                    </div>
                    <div class="w-full flex space-x-4 items-center py-4">
                        <button type="submit" 
                        class="poppins text-base text-white bg-blue-500 hover:bg-blue-600 border border-blue-500 hover:border-blue-600 py-2 px-10 rounded">Update</button>
                        <a href="/updates/list" 
                        class="poppins py-2 px-6 text-base text-red-600 border border-red-400 hover:border-red-400 hover:text-red-600 rounded">Cancel</a>
                    </div>
                </div>
                <div class="w-1/2 flex flex-col space-y-4">
                    <div class="flex flex-col">
                        <div class="flex items-center space-x-2">
                            <label class="poppins text-base text-gray-700 font-semibold" for="title">Title</label>
                            <span class="error poppins text-red-500 text-sm"></span>
                        </div>
                        <input id="title" name="title" class="poppins text-sm py-2 px-4 border rounded focus:outline-none border-gray-400 focus:border-gray-600" 
                            type="text" 
                            placeholder="Type the title here"
                            value="{{$updates->title}}">
                    </div>
                    <div class="flex flex-col">
                        <div class="flex items-center space-x-2">
                            <label class="poppins text-base text-gray-700 font-semibold" for="title">Tags</label>
                            <span class="error poppins text-red-500 text-sm"></span>
                        </div>
                        <input id="tag" name="tag" class="poppins text-sm py-2 px-4 border rounded focus:outline-none border-gray-400 focus:border-gray-600" 
                            type="text" 
                            placeholder="Type the title here"
                            value="{{$updates->tag}}">
                    </div>
                    <div class="flex flex-col h-96">
                        <div class="flex items-center space-x-2">
                            <label class="poppins text-base text-gray-700 font-semibold py-2" for="description">Description</label>
                            <span class="error poppins text-red-500 text-sm"></span>
                        </div>
                        <textarea id="description" name="description" class="h-400px poppins text-sm py-2 px-4 border rounded focus:outline-none border-gray-400 focus:border-gray-600" 
                        type="text" placeholder="Type the description here">
                        {{$updates->description}}</textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>  
</x-guidance-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{ asset('js/update_edit.js') }}"></script>