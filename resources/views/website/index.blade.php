<x-web-layout>

    @include('website.partials._hero')

    <section class="">
        <div class="container mx-auto tablet:px-24">
            <div class="py-16">
                <div class="flex flex-col items-center justify-center space-y-6 pb-12">
                    <h1 class="castoro text-5xl text-lightblack font-bold text-center">News and Updates</h1>
                    <div class="flex items-center">
                        <a class="poppins text-base text-blue hover:underline" href="/updates">See More News</a>
                    </div>
                </div>
    
                <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4">
                    @foreach ($updates as $update)
                        <x-updates-home-card :update="$update"/>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- @include('partials._news', ['updates' => $updates]) --}}

    @include('website.partials._missionvision')
    
    @include('website.partials._feedback')

    @if(isset($removeActiveLinkId) && $removeActiveLinkId)
        <script>
            localStorage.removeItem('activeLinkId');
        </script>
    @endif

</x-web-layout>
