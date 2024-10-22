<footer class="bg-lightgray">
    <div class="w-full max-w-[1300px] mx-auto px-4">
        <div class="flex flex-col tablet:flex-row justify-between items-start py-12 border-b-2 border-gray-300 space-y-4 tablet:space-y-0">

            <div class="w-full tablet:w-auto flex flex-col">
                <div class="flex justify-center tablet:justify-start items-center space-x-2 text-gray-700">
                    <img class="w-[80px] h-[80px]" src="{{asset('image/mambog.png')}}" alt="">
                    <div class="flex flex-col">
                        <p class="castoro text-lg font-bold">MAMBOG</p>
                        <p class="castoro text-sm font-medium">ELEMENTARY SCHOOL</p>
                    </div>
                </div>
                <div class="flex justify-center tablet:justify-start py-4 px-1">
                    <img class="h-[50px] w-[150px]" src="{{asset('image/deped.png')}}" alt="">
                </div>
                <div class="flex justify-center tablet:justify-start py-4 px-1">
                    <img class="h-[70px]" src="{{asset('image/deped/deped-circle.png')}}" alt="">
                </div>
            </div>

            <div class="w-full tablet:w-auto flex flex-col space-y-4">
                <h1 class="poppins text-lg font-semibold text-black text-center tablet:text-left">Government Links</h1>
                <div class="flex flex-col space-y-2">
                    <a class="poppins text-sm font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left"
                    href="https://www.officialgazette.gov.ph/" target="_blank" rel="noopener noreferrer">Government PH</a>
                    <a class="poppins text-sm font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left"
                    href="https://www.deped.gov.ph/" target="_blank" rel="noopener noreferrer">DepEd</a>
                    <a class="poppins text-sm font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left"
                    href="https://cavite.gov.ph/home/" target="_blank" rel="noopener noreferrer">Cavite PH</a>
                    <a class="poppins text-sm font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left"
                    href="https://bacoor.gov.ph/" target="_blank" rel="noopener noreferrer">Bacoor PH</a>
                </div>
            </div>

            <div class="w-full tablet:w-auto flex flex-col space-y-4">
                <h1 class="poppins text-lg font-semibold text-black text-center tablet:text-left">Quick Links</h1>
                <div class="flex flex-col space-y-2">
                    <a class="poppins text-sm font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left" href="{{ route('module.index') }}">Modules</a>
                    <a class="poppins text-sm font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left" href="{{ route('video.index') }}">Video Lessons</a>
                    <a class="poppins text-sm font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left" href="{{ route('update.index') }}">News and Announcements</a>
                    <a class="poppins text-sm font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left" href="{{ route('achievements.index') }}">Awards and Achievements</a>
                    <a class="poppins text-sm font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left" href="{{ route('org.chart') }}">Organizational Structure</a>
                    <a class="poppins text-sm font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left" href="{{ route('calendar.show') }}">Calendar of Acvtivities</a>
                    <a class="poppins text-sm font-normal text-lightestgray hover:text-red-500 hover:underline text-center tablet:text-left" href="{{ route('downloadables.index') }}">Downloadables</a>
                </div>
            </div>

            <div class="w-full tablet:w-auto flex flex-col space-y-4">
                <h1 class="poppins text-lg font-semibold text-black text-center tablet:text-left">Contact Information</h1>
                <div class="flex flex-col space-y-2">
                    <div class="flex flex-col">
                        <a class="poppins text-sm font-light text-lightestgray hover:text-red-500 text-center tablet:text-left" href="#">Mambog III, Bacoor City, Cavite</a>
                        <a class="poppins text-sm font-light text-lightestgray hover:text-red-500 text-center tablet:text-left" href="#">Region IV - CALABARZON</a>
                    </div>
                    <div class="flex flex-col">
                        <a class="poppins text-sm font-light text-lightestgray hover:text-red-500 text-center tablet:text-left" href="#">Contact: 471-10-00</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-start py-6">
            <div class="w-full tablet:w-auto flex items-center justify-center">
                <div class="flex items-center space-x-2">
                    <i class='bx bx-copyright text-light text-lg text-gray-400'></i>
                    <p class="poppins text-base font-light text-gray-400">2023 Mambog Elementary School</p>
                </div>
            </div>
        </div>
    </div>
</footer>
