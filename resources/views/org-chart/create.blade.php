<x-guidance-layout>
    <section>
        <div class="p-4">
            <h1 class="poppins pb-3 mb-3 text-lg font-medium border-b-2 border-gray-200">ORGANIZATION CHART</h1>

            <div class="flex flex-col space-y-2">
                @if ($orgChartRows->isEmpty())
                    <div class="w-full h-14 flex justify-center items-center">
                        <p class="poppins text-sm text-red-600">No rows yet.</p>
                    </div>
                @else
                    @foreach ($orgChartRows as $row)
                        <div class="w-full h-fit min-h-[150px] p-1 border border-gray-300 relative">
                            <p class="poppins font-semibold text-center pb-2">{{ $row->title ?? '' }}</p>

                            @if ($row->orgChartRowItems)
                                <div class="w-full flex justify-center items-center space-x-4 overflow-x-auto">
                                    @foreach ($row->orgChartRowItems as $item)
                                        <div class="w-36 min-w-[128px] h-full p-2 rounded border border-gray-300 relative group">
                                            <div class="w-full h-24 bg-gray-100 flex justify-center items-center">
                                                <img src="{{ asset('storage/' . $item->image) }}" alt=""
                                                    class="h-full">
                                            </div>
                                            <p class="text-sm text-center font-bold">{{ $item->name ?? '' }}</p>
                                            <p class="text-xs text-center">{{ $item->position ?? '' }}</p>
                                            <div
                                                class="absolute top-0 left-0 w-full h-full bg-white flex space-x-2 justify-center items-center cursor-pointer opacity-0 group-hover:opacity-100">
                                                <i data-item-id="{{ $item->id }}"
                                                    class=' updateItemBtn bx bx-edit text-blue-500 text-base cursor-pointer rounded bg-blue-50 py-1 px-2'></i>
                                                <form action="{{ route('org.chart.item.delete', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">
                                                        <i
                                                            class='bx bx-trash text-red-500 text-base rounded bg-red-50 cursor-pointer py-1 px-2'></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            {{-- add row item button --}}
                            <div
                                class="absolute top-1/2 left-3 transform -translate-y-1/2 flex flex-col space-y-2 cursor-pointer">
                                <button data-row-id="{{ $row->id }}"
                                    class="addItemBtn flex justify-center items-center py-1 px-2 rounded-full border bprder-gray-300 bg-white">
                                    <i class='bx bx-plus text-sm text-gray-600 hover:text-green-600'></i>
                                </button>
                                <button data-row-id="{{ $row->id }}"
                                    class="updateRowBtn flex justify-center items-center py-1 px-2 rounded-full border bprder-gray-300 bg-white">
                                    <i class='bx bx-edit text-gray-600 hover:text-blue-500 text-sm cursor-pointer'></i>
                                </button>
                                <form action="{{ route('org.chart.delete', $row->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button data-row-id="{{ $row->id }}"
                                        class="flex justify-center items-center py-1 px-2 rounded-full border bprder-gray-300 bg-white">
                                        <i class='bx bx-trash text-gray-600 hover:text-red-500 text-sm'></i>
                                    </button>
                                </form>
                            </div>

                            <div
                                class="absolute top-1/2 right-3 transform -translate-y-1/2 flex flex-col space-y-2 cursor-pointer">
                                <p class="text-2xl font-bold opacity-50">{{ $row->order }}</p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <form action="{{ route('org.chart.store') }}" method="POST" class="py-4">
                @csrf
                <button class="px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded cursor-pointer">
                    Add Row
                </button>
            </form>


            {{-- add item modal --}}
            <div id="addItemModal"
                class="hidden fixed top-0 left-0 w-full h-full min-h-screen bg-black bg-opacity-10 flex justify-center items-center p-8 z-50">
                <form action="{{ route('org.chart.item.store') }}" method="POST" enctype="multipart/form-data"
                    class="rounded p-6 bg-white w-full md:w-2/5">
                    @csrf
                    <div class="w-fill flex justify-end">
                        <i class='bx bx-x text-xl text-gray-500 cursor-pointer hover:text-red-600 closeBtn'></i>
                    </div>
                    <input type="hidden" name="rowId" value="">
                    <div class="flex flex-col space-y-4">
                        <div class="flex flex-col space-y-1">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="rounded border border-gray-300 text-sm">
                            @error('name')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="name">Position</label>
                            <input type="text" name="position" id="position" value="{{ old('position') }}"
                                class="rounded border border-gray-300 text-sm">
                            @error('position')
                                <p>{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col space-y-1 items-start justify-start w-full">
                            <label class="poppins text-sm font-semibold">Image
                                @error('image')
                                    <span class="text-xs font-light text-red-600">{{ $message }}</span>
                                @enderror
                            </label>
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div id="description" class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or GIF</p>
                                </div>
                                <img id="image-preview" src="#" alt="Preview"
                                    class="hidden w-full h-full rounded-md" />
                                <input id="dropzone-file" type="file" name="image" class="hidden"
                                    accept="image/png, image/jpeg, image/gif" onchange="previewCoverPhoto(this)" />
                            </label>
                        </div>
                        <div class="w-full">
                            <button type="submit"
                                class="w-full px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded cursor-pointer">
                                Add
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div id="updateItemModal"
                class="hidden fixed top-0 left-0 w-full h-full min-h-screen bg-black bg-opacity-10 flex justify-center items-center p-8 z-50">
                <form action="{{ route('org.chart.item.update') }}" method="POST" enctype="multipart/form-data"
                    class="rounded p-6 bg-white w-full md:w-2/5">
                    @csrf
                    @method('PUT')
                    <div class="w-fill flex justify-end">
                        <i
                            class='bx bx-x text-xl text-gray-500 cursor-pointer hover:text-red-600 updateItemCloseBtn'></i>
                    </div>
                    <input type="hidden" name="itemId" value="">
                    <div class="flex flex-col space-y-4">
                        <div class="flex flex-col space-y-1">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name"
                                class="rounded border border-gray-300 text-sm">
                        </div>
                        <div class="flex flex-col space-y-1">
                            <label for="name">Position</label>
                            <input type="text" name="position" id="position"
                                class="rounded border border-gray-300 text-sm">
                        </div>
                        <div class="flex flex-col space-y-1 items-start justify-start w-full">
                            <label class="poppins text-sm font-semibold">Image</label>
                            <label for="update-dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div id="updateItem-description" class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG or GIF</p>
                                </div>
                                <img id="updateItem-image-preview" src="#" alt="Preview" class="hidden w-full h-full rounded-md" />
                                <input id="update-dropzone-file" type="file" name="image" class="hidden"
                                    accept="image/png, image/jpeg, image/gif" onchange="previewUpdateCoverPhoto(this)" />
                            </label>
                        </div>
                        <div class="w-full">
                            <button type="submit"
                                class="w-full px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded cursor-pointer">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div id="updateRowModal"
                class="hidden fixed top-0 left-0 w-full h-full min-h-screen bg-black bg-opacity-10 flex justify-center items-center p-8 z-50">
                <form action="{{ route('org.chart.update') }}" method="POST" class="rounded p-6 bg-white w-full md:w-2/5">
                    @csrf
                    @method('PUT')
                    <div class="w-fill flex justify-end">
                        <i
                            class='bx bx-x text-xl text-gray-500 cursor-pointer hover:text-red-600 updateRowCloseBtn'></i>
                    </div>
                    <input type="hidden" name="rowId" value="">
                    <div class="flex flex-col space-y-4">
                        <div class="flex flex-col space-y-1">
                            <label>Row Title</label>
                            <input name="title" type="text" placeholder="Row title.."
                                class="rounded border border-gray-300 text-sm">
                        </div>
                        <div class="flex flex-col space-y-1">
                            @php
                                $rowOrders = [];
                                for ($i = 1; $i <= $totalRows; $i++) {
                                    $rowOrders[] = $i;
                                }
                            @endphp
                            <label>Row Order</label>
                            <select name="order" id="order" class="rounded border border-gray-300 text-sm">
                                @foreach ($rowOrders as $order)
                                    <option value="{{ $order }}">{{ $order }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full">
                            <button type="submit"
                                class="w-full px-4 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded cursor-pointer">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <script>
                setupModal('.addItemBtn', 'addItemModal', 'input[name="rowId"]', 'data-row-id', '.closeBtn');
                setupModal('.updateRowBtn', 'updateRowModal', 'input[name="rowId"]', 'data-row-id', '.updateRowCloseBtn');
                setupModal('.updateItemBtn', 'updateItemModal', 'input[name="itemId"]', 'data-item-id', '.updateItemCloseBtn');

                function setupModal(buttonSelector, modalId, inputSelector, dataAttribute, closeBtnSelector) {
                    const buttons = document.querySelectorAll(buttonSelector);
                    const modal = document.getElementById(modalId);
                    const input = modal.querySelector(inputSelector);
                    const closeBtn = document.querySelector(closeBtnSelector);

                    buttons.forEach(button => {
                        button.addEventListener('click', function() {
                            modal.classList.remove('hidden');
                            input.value = button.getAttribute(dataAttribute);
                        });
                    });

                    closeBtn.addEventListener('click', function() {
                        modal.classList.add('hidden');
                    });
                }

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

                function previewUpdateCoverPhoto(input) {
                    var updateImagePreview = document.getElementById('updateItem-image-preview');
                    var updateDescription = document.getElementById('updateItem-description');

                    if (input.files && input.files[0]) {
                        var imgReader = new FileReader();

                        imgReader.onload = function(e) {
                            updateImagePreview.src = e.target.result;
                            updateImagePreview.classList.remove('hidden');
                            updateDescription.classList.add('hidden');
                        };

                        imgReader.readAsDataURL(input.files[0]);
                    } else {
                        updateImagePreview.src = '';
                        updateImagePreview.classList.add('hidden');
                        updateDescription.classList.remove('hidden');
                    }
                }
            </script>

        </div>
    </section>
</x-guidance-layout>
