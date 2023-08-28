<x-faculty-layout>
    <section class="w-full flex items-start relative">
        <div class="w-full h-660px flex flex-col items-start p-2 overflow-auto">
            <div>
                <a id="back" class="flex w-fit justify-start items-center space-x-2 py-1 px-4 group rounded bg-gray-200 hover:bg-gray-300 cursor-pointer group" href="/classes">
                    <i class='bx bx-left-arrow-alt text-black text-lg '></i>
                    <p class="poppins text-sm text-black">Back</p>
                </a>
            </div>

            <div class="flex items-center space-x-2 py-2">
                <p class="poppins text-base text-blue-800 font-medium">Class Name:</p>
                <p class="poppins text-base text-blue-800 font-medium">{{$class_record->name}}</p>
            </div>

            <div class="w-full">
                {{-- Evaluations --}}
                <x-evaluations :evaluations="$evaluations" />

                <div class="eval-container">
                    <x-written-works :students="$students" :evaluations="$evaluations" :activities="$wr_activities" :classrecord="$class_record"/>  {{--  :activities="$wr_activities" --}}
                    {{-- <x-performance-task /> --}}
                    {{-- <x-quarterly-assessment /> --}}
                    {{-- <x-final-grade />    --}}
                </div>
            </div>

        </div>

        <x-wr-modal :evaluations="$evaluations" :classrecord="$class_record"/>
        <x-pt-modal />
        <x-qa-modal />

    </section>
</x-faculty-layout>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
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