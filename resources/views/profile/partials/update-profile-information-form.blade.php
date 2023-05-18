<section class="w-full">
    
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="w-full mt-6 flex justify-between" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="w-full flex items-start space-x-12">
            <div class="lg:w-1/2 sm:w-full space-y-6">
                <header>
                    <h2 class="poppins text-lg font-medium text-gray-900">
                        {{ __('Profile Information') }}
                    </h2>
            
                    <p class="poppins mt-1 text-sm text-gray-600">
                        {{ __("Update your account's profile information and email address.") }}
                    </p>
                </header>

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
        
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                    <x-input-error class="mt-2" :messages="$errors->get('email')" />
        
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div>
                            <p class="text-sm mt-2 text-gray-800">
                                {{ __('Your email address is unverified.') }}
        
                                <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </p>
        
                            @if (session('status') === 'verification-link-sent')
                                <p class="mt-2 font-medium text-sm text-green-600">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </p>
                            @endif
                        </div>
                    @endif
                </div>
        
                <div class="flex items-center gap-4">
                    <x-primary-button>{{ __('Save') }}</x-primary-button>
        
                    @if (session('status') === 'profile-updated')
                        <p
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition
                            x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600"
                        >{{ __('Saved.') }}</p>
                    @endif
                </div>
            </div>
    
            <div class="">
                <div id="photo-preview" class="h-60 w-64 flex items-center justify-center bg-gray-100 bg-cover bg-center rounded shadow-md"
                    style="background-image: url('{{ asset('storage/' . $user->image) }}')">
                    @if (!$user->image)
                        <p class="poppins text-lg text-gray-400 font-semibold">Upload a photo</p>
                    @endif
                </div>
                <div class="relative py-4">
                    <label>
                        <input name="image" type="file" id="photo-input" class="poppins text-sm mr-2
                        file:mr-5 file:py-2 file:px-4
                        file:rounded file:border-0
                        file:text-sm file:font-medium
                        file:bg-green-400 file:text-white file:border file:border-gray-400 file:cursor:pointer" />
                    </label>
                    <span class="error poppins text-red-500 text-sm"></span>
                </div>
            </div>

        </div>

       
    </form>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {

        const photoInput = $('#photo-input');
        const photoPreview = $('#photo-preview');
        const photoPlaceholder = photoPreview.find('p');
        
        photoInput.on('change', function() {
            const file = this.files[0];
            const reader = new FileReader();
        
            reader.addEventListener('load', function() {
                photoPreview.css('background-image', `url(${reader.result})`);

                if (photoPreview.css('background-image') !== 'none') {
                    photoPlaceholder.hide();
                }
            });
        
            if (file) {
                reader.readAsDataURL(file);
            }
        });
    });

</script>
