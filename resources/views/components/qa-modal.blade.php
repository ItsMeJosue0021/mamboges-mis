<div id="assessment-modal" class="hidden w-full h-full absolute top-0 left-0  pt-40 justify-center bg-black bg-opacity-5">
    <div class="w-96 h-fit rounded-md bg-white">
        <form class="flex flex-col space-y-3 py-4 px-6" action="">
            <div>
                <h1 class="poppins font-semibold">New Assessment</h1>
            </div>
            <div class="flex flex-col space-y-1">
                <label class="poppins text-xs" for="">TITLE</label>
                <input class="poppins text-sm px-4 rounded" type="text">
            </div>
            <div class="flex flex-col space-y-1">
                <label class="poppins text-xs" for="">HIGHEST POSSIBLE SCORE</label>
                <input class="poppins text-sm px-4 rounded" type="text">
            </div>
            <div class="flex items-center justify-end space-x-4 pt-2">
                <button class="poppins py-2 px-4 bg-blue-400 text-white hover:bg-blue-500 rounded">Save</button>
                <a id="assessment-cancel" class="poppins cursor-pointer hover:text-red-500">Cancel</a>
            </div>
        </form>
    </div>
</div>