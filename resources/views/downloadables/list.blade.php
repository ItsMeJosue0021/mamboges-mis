<x-guidance-layout>
    <div class="w-full h-full flex justify-center items-start p-4">
        <div class="w-full" id="uploadFormWrapper">
            <form action="{{ route('downloadables.store') }}" method="POST" enctype="multipart/form-data" class="w-1/2 flex flex-col space-y-4">
                @csrf
                <div>
                    <h1 class="poppins text-lg font-medium">UPLOAD DOWNLOADABLE FILES</h1>
                    <div class="rounded shadow-md p-4 border border-gray-100">
                        <div class="flex flex-col space-y-1">
                            <label class="poppins text-sm font-semibold">
                                Group Name
                                <span id="error" class="text-red-600 text-xs font-normal"></span>
                            </label>
                            <input name="groupName"  id="groupName" type="text" placeholder="Please provide a group name.."
                                class="poppins text-sm px-4 py-2 rounded border-2 border-gray-200">
                            <div class="pt-2 flex justify-between">
                                <!-- Add Files Button -->
                                <a id="addFilesBtn" class="px-4 py-2 text-sm bg-blue-600 text-white rounded cursor-pointer">
                                    Add Files
                                </a>
                                <button type="submit" id="submitBtn"
                                class="px-4 py-2 text-sm font-bold text-blue-600 bg-white border-2 border-blue-600 rounded cursor-pointer hover:bg-blue-600 hover:text-white">
                                    Upload
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="fileContainers" class="flex flex-col space-y-2">
                    <!-- Initially, no file containers here --> 
                </div>
            </form>
            
            <div>

            </div>
        </div>
    </div>
</x-guidance-layout>

<script>
    // JavaScript to dynamically add and remove file upload containers
    document.addEventListener('DOMContentLoaded', function () {
        const addFilesBtn = document.getElementById('addFilesBtn');
        const fileContainers = document.getElementById('fileContainers');
        const submitBtn = document.getElementById('submitBtn');
        const groupNameInput = document.getElementById('groupName');
        const uploadFormWrapper = document.getElementById('uploadFormWrapper');
        const errorMessage = document.getElementById('error');

        uploadFormWrapper.addEventListener('submit', function (e) {
            if (groupNameInput.value.trim() === '') {
                e.preventDefault();
                errorMessage.innerText = 'Please provide a group name before uploading files.';
            } else {
                errorMessage.innerText = '';
            }
        });

        groupNameInput.addEventListener('keyup', function () {
            errorMessage.innerText = '';
        });

        function createFileContainer() {
            const fileContainer = document.createElement('div');
            fileContainer.className = 'rounded border border-gray-200 p-3 shadow-md relative';
            fileContainer.innerHTML = `
                <div class="w-full flex flex-row justify-between items-center">
                    <div class="w-full flex flex-col space-y-2">
                        <div class="flex justify-between items-end">
                            <label class="poppins text-sm font-semibold">Name</label>
                        </div>
                        <input name="names[]" type="text" placeholder="Please provide a name for the file.."
                            class="poppins text-sm px-4 py-2 rounded border-2 border-gray-200">
                        <input class="relative m-0 block w-full min-w-0 flex-auto rounded border border-solid border-neutral-300 bg-clip-padding px-3 py-[0.32rem] 
                            text-base font-normal text-neutral-700 transition duration-300 ease-in-out file:-mx-3 file:-my-[0.32rem] file:overflow-hidden 
                            file:rounded-none file:border-0 file:border-solid file:border-inherit file:bg-neutral-100 file:px-3 file:py-[0.32rem] 
                            file:text-neutral-700 file:transition file:duration-150 file:ease-in-out file:[border-inline-end-width:1px] 
                            file:[margin-inline-end:0.75rem] hover:file:bg-neutral-200 focus:border-primary focus:text-neutral-700 
                            focus:shadow-te-primary focus:outline-none dark:border-neutral-600 dark:text-neutral-200 dark:file:bg-neutral-700
                            dark:file:text-neutral-100 dark:focus:border-primary"
                            type="file"
                            name="files[]"
                            accept=".pdf"
                            id="formFile">
                    </div>
                    <button class="absolute top-1 right-1 px-2 py-1 rounded deleteFileBtn">
                        <i class='bx bx-trash text-lg text-gray-500 hover:text-red-600'></i>
                    </button>
                </div>`;
            return fileContainer;
        }

        function hasFileContainers() {
            return fileContainers.children.length > 0;
        }

        function toggleSubmitButtonVisibility() {
            submitBtn.style.display = hasFileContainers() ? 'block' : 'none';
        }

        addFilesBtn.addEventListener('click', function () {
            const fileContainer = createFileContainer();
            fileContainers.appendChild(fileContainer);

            const deleteFileBtns = fileContainers.querySelectorAll('.deleteFileBtn');
            deleteFileBtns.forEach(function (btn) {
                btn.addEventListener('click', function () {
                    fileContainers.removeChild(btn.parentElement.parentElement);
                    toggleSubmitButtonVisibility();
                });
            });
            toggleSubmitButtonVisibility();
        });

        toggleSubmitButtonVisibility();
    });
</script>
