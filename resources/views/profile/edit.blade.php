<x-app-layout>

    <div class="container mt-4">

        <div class="card p-4 shadow-sm">

            <h2 class="mb-4">Edit Profile</h2>

            <form method="POST"
                  action="{{ route('profile.update') }}"
                  enctype="multipart/form-data">

                @csrf
                @method('PATCH')

                <!-- NAME -->
                <div class="mb-3">

                    <label>Name</label>

                    <input type="text"
                           name="name"
                           value="{{ auth()->user()->name }}"
                           class="form-control">

                </div>

                <!-- BIO -->
                <div class="mb-3">

                    <label>Bio</label>

                    <textarea name="bio"
                              class="form-control"
                              rows="4">{{ auth()->user()->bio }}</textarea>

                </div>

                <!-- AVATAR -->
                <div class="mb-3">

                    <label>Profile Image</label>

                    <input type="file"
                           name="avatar"
                           class="form-control">

                </div>

                <!-- CURRENT IMAGE -->
                @if(auth()->user()->avatar)

                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}"
                         width="120"
                         class="rounded-circle mb-3">

                @endif

                <button class="btn btn-primary">
                    Update Profile
                </button>

            </form>

        </div>

    </div>

</x-app-layout>