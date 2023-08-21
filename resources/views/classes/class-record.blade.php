<x-faculty-layout>
    <section class="w-full flex items-start relative">
        <div class="w-full h-660px flex flex-col items-start p-2 overflow-auto">
            <div class="pb-2">
                <a id="back" class="flex w-fit justify-start items-center space-x-2 group rounded cursor-pointer" href="/classes">
                    <i class='bx bx-left-arrow-alt text-gray-600 text-2xl group-hover:text-red-700'></i>
                    <p class="poppins text-base text-gray-600 group-hover:text-red-700">back</p>
                </a>
            </div>

            <div class="w-full">
                {{-- Evaluations --}}
                <x-evaluations :evaluations="$evaluations" />

                <div class="eval-container">
                    <x-written-works :students="$students" :evaluations="$evaluations"  />  {{--  :activities="$wr_activities" --}}
                    {{-- <x-performance-task /> --}}
                    {{-- <x-quarterly-assessment /> --}}
                    {{-- <x-final-grade />    --}}
                </div>
            </div>

        </div>

        <x-wr-modal />
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