<x-faculty-layout>
    <section class="w-full flex items-start relative">
        <div class="w-full h-660px flex flex-col items-start p-2 overflow-auto">
            <div>
                <a id="back" class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group" href="/classes">
                    <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                    <p class="poppins text-sm text-black">Back</p>
                </a>
            </div>

            <div class="w-full flex justify-between items-center py-2">
                <div class="flex space-x-4 items-center">
                    <div class="flex items-center rounded border border-blue-600" id="classRecordId" data-class-record-id="{{ $class_record->id}}">
                        <p class="poppins text-sm bg-blue-600 text-white px-4 py-2">Class Name</p>
                        <p class="poppins text-sm font-medium px-4 py-2 text-blue-600">{{$class_record->name}}</p>
                    </div>
                    <div class="flex items-center rounded border border-blue-600">
                        <p class="poppins text-sm bg-blue-600 text-white px-4 py-2">Teacher</p>
                        <p class="poppins text-sm font-medium px-4 py-2 flex space-x-2 items-center text-blue-600">
                            <span>{{$class_record->faculty->user->profile->firstName}}</span>
                            <span>{{$class_record->faculty->user->profile->lastName}}</span>
                        </p>
                    </div>
                </div>
                
                <div class="flex space-x-2 items-center">
                    <span class="poppins text-sm bg-blue-600 text-white rounded px-4 py-2">Quarter</span>
                    <a href="?quarter=1" class="quarter poppins text-sm bg-gray-200 rounded px-4 py-2 hover:bg-blue-800 hover:text-white">1</a>
                    <a href="?quarter=2" class="quarter poppins text-sm bg-gray-200 rounded px-4 py-2 hover:bg-blue-800 hover:text-white">2</a>
                    <a href="?quarter=3" class="quarter poppins text-sm bg-gray-200 rounded px-4 py-2 hover:bg-blue-800 hover:text-white">3</a>
                    <a href="?quarter=4" class="quarter poppins text-sm bg-gray-200 rounded px-4 py-2 hover:bg-blue-800 hover:text-white">4</a>
                </div>
            </div>

            <div class="w-full">
                {{-- Evaluations --}}
                <x-evaluations :evaluations="$evaluations" />

                <div class="eval-container">
                    <x-written-works :students="$students" :evaluations="$evaluations" :activities="$wr_activities" :classrecord="$class_record"/>  {{--  :activities="$wr_activities" --}}
                    <x-performance-task :students="$students" :evaluations="$evaluations" :activities="$pt_activities" :classrecord="$class_record"/> 
                    <x-quarterly-assessment :students="$students" :evaluations="$evaluations" :activities="$qa_activities" :classrecord="$class_record"/>
                    <x-final-grade :students="$students" :classrecord="$class_record" />   
                </div>
            </div>
        </div>

        <x-wr-modal :evaluations="$evaluations" :classrecord="$class_record" />
        <x-pt-modal :evaluations="$evaluations" :classrecord="$class_record" />
        <x-qa-modal :evaluations="$evaluations" :classrecord="$class_record" />

    </section>
</x-faculty-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const urlParams = new URLSearchParams(window.location.search);
        const currentQuarter = urlParams.get('quarter');
        
        const quarters = document.querySelectorAll('.quarter');
        if (currentQuarter === null) {
            quarters[0].classList.add('active-quarter'); 
        } else {
            quarters.forEach(quarter => {
                const quarterValue = quarter.getAttribute('href').split('=')[1];
                if (quarterValue === currentQuarter) {
                    quarter.classList.add('active-quarter');
                }
            });
        }
        
        quarters.forEach(quarter => {
            quarter.addEventListener('click', () => {
                quarters.forEach(q => q.classList.remove('active-quarter'));
                quarter.classList.add('active-quarter');
            });
        });
        
        const evalnavItems = document.querySelectorAll('.evalnav');
    
        evalnavItems.forEach((item) => {
            item.addEventListener('click', function() {
                evalnavItems.forEach((navItem) => navItem.classList.remove('active-eval'));
                this.classList.add('active-eval');
    
                const h1Text = this.querySelector('h1').textContent;
                const sections = ['performance', 'quarterly', 'written', 'final'];
    
                sections.forEach((section) => {
                    const element = document.getElementById(section);
                    if (h1Text.toUpperCase().includes(section.toUpperCase())) {
                        sections.forEach((otherSection) => {
                            if (otherSection !== section) {
                                document.getElementById(otherSection).classList.add('hidden');
                            }
                        });
                        element.classList.remove('hidden');
                    } else {
                        element.classList.add('hidden');
                    }
                });
            });
        });

        const showModal = (modal) => modal.classList.remove('hidden');
        const hideModal = (modal) => modal.classList.add('hidden');
    
        const modals = [
            { buttonId: 'new-written-act', modalId: 'written-modal', cancelId: 'written-act-cancel' },
            { buttonId: 'new-pt-act', modalId: 'pt-modal', cancelId: 'pt-act-cancel' },
            { buttonId: 'new-assessment', modalId: 'assessment-modal', cancelId: 'assessment-cancel' }
        ];
    
        modals.forEach(({ buttonId, modalId, cancelId }) => {
            const newBtn = document.getElementById(buttonId);
            const modal = document.getElementById(modalId);
            const cancel = document.getElementById(cancelId);
    
            newBtn.addEventListener('click', () => showModal(modal));
            cancel.addEventListener('click', () => hideModal(modal));
        });
    });
</script>