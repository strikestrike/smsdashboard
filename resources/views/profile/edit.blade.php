<x-admin>
    @section('title')
        {{ 'Edit Your Profile' }}
    @endsection
    <div class="container">
        <div class="p-3 mb-3">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-3">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-3">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- <div class="d-none">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div> --}}
        </div>
    </div>
</x-admin>
