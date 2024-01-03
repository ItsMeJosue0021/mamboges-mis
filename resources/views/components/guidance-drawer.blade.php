<div id="drawer-navigation" class="fixed top-0 left-0 z-50 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-64 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-navigation-label">
    <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">Menu</h5>
    <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <div class="py-4 overflow-y-auto">
        <ul class="space-y-1 font-medium">
            <li>
                <a id="link6"
                    class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                    href="{{ route('update.list') }}">
                    <i class='bx bx-news text-xl text-lightblack group-hover:text-blue-600'></i>
                    <p class="poppins text-sm group-hover:text-blue-600">News & Updates</p>
                </a>
            </li>

            <li>
                <a id="link13"
                    class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                    href="/feedback">
                    <i class='bx bx-comment-dots text-xl text-lightblack group-hover:text-blue-600'></i>
                    <p class="poppins text-sm group-hover:text-blue-600">Feedback</p>
                </a>
            </li>
            <li>
                <a id="link14"
                    class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                    href="{{ route('achievements.list') }}">
                    <i class='bx bx-award text-xl text-lightblack group-hover:text-blue-600'></i>
                    <p class="poppins text-sm group-hover:text-blue-600">Achievement</p>
                </a>
            </li>
            <li>
                <a id="link15"
                    class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                    href="{{ route('downloadables.list') }}">
                    <i class='bx bx-file text-xl text-lightblack group-hover:text-blue-600'></i>
                    <p class="poppins text-sm group-hover:text-blue-600">Downloadables</p>
                </a>
            </li>
            <li>
                <a id="link16"
                    class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                    href="{{ route('calendar.index') }}">
                    <i class='bx bx-calendar text-xl text-lightblack group-hover:text-blue-600'></i>
                    <p class="poppins text-sm group-hover:text-blue-600">Calendar</p>
                </a>
            </li>
            <li>
                <a id="link17"
                    class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                    href="{{ route('org.chart.create') }}">
                    <i class='bx bx-network-chart text-xl text-lightblack group-hover:text-blue-600'></i>
                    <p class="poppins text-sm group-hover:text-blue-600">Organization</p>
                </a>
            </li>
            <li>
                <a id="link2"
                    class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                    href="/students">
                    <i class='bx bx-user-circle text-xl text-lightblack group-hover:text-blue-600'></i>
                    <p class="poppins text-sm group-hover:text-blue-600">Learners</p>
                </a>
            </li>
            <li>
                <a id="link3"
                    class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                    href="/faculties">
                    <i class='bx bx-user-pin text-xl text-lightblack group-hover:text-blue-600'></i>
                    <p class="poppins text-sm group-hover:text-blue-600">Faculties</p>
                </a>
            </li>
            <li>
                <a id="link1"
                    class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                    href="/sections">
                    <i class='bx bx-folder text-xl text-lightblack group-hover:text-blue-600'></i>
                    <p class="poppins text-sm group-hover:text-blue-600">Sections</p>
                </a>
            </li>
            <li>
                <a id="link8"
                    class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                    href="/subjects">
                    <i class='bx bx-book-alt text-xl text-lightblack group-hover:text-blue-600'></i>
                    <p class="poppins text-sm group-hover:text-blue-600">Subjects</p>
                </a>
            </li>
            <li>
                <a id="link4"
                    class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                    href="/departments">
                    <i class='bx bx-category text-xl text-lightblack group-hover:text-blue-600'></i>
                    <p class="poppins text-sm group-hover:text-blue-600">Departments</p>
                </a>
            </li>
            <li>
                <button type="button" class="w-full flex group items-center justify-between p-2 rounded hover:bg-blue-50 focus:bg-blue-50 cursor-pointer" aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <div class="flex items-center space-x-4">
                        <i class='bx bx-cog text-xl text-lightblack group-hover:text-blue-600'></i>
                        <p class="poppins text-sm group-hover:text-blue-600">Settings</p>
                    </div>
                    <i class='bx bx-chevron-down text-xl'></i>
                </button>
                <ul id="dropdown-example" class="hidden py-2 space-y-1">
                    <li>
                        <a id="link9"
                            class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                            href="/logs">
                            <i class='bx bx-list-ul text-xl text-lightblack group-hover:text-blue-600'></i>
                            <p class="poppins text-sm group-hover:text-blue-600">Logs</p>
                        </a>
                    </li>
                    <li>
                        <a id="link10"
                            class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                            href="{{ route('archive.students') }}">
                            <i class='bx bx-archive text-xl text-lightblack group-hover:text-blue-600'></i>
                            <p class="poppins text-sm group-hover:text-blue-600">Archive</p>
                        </a>
                    </li>
                    <li>
                        <a id="link11"
                            class="flex group items-center space-x-4 p-2 rounded hover:bg-blue-50 focus:bg-blue-50"
                            href="/settings">
                            <i class='bx bx-calendar text-xl text-lightblack group-hover:text-blue-600'></i>
                            <p class="poppins text-sm group-hover:text-blue-600">School Year</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
