<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit User
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <form class="space-y-6" 
                                enctype="multipart/form-data"
                                method="POST"
                                action="{{ route('member.users.update',['user'=>$userData->id]) }}">
                                @csrf
                                @method('PUT')
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    Edit Data User
                                </h2>
                                <p class="mt-1 text-sm text-gray-600">
                                    Silakan melakukan perubahan data
                                </p>
                            </header>
                            <div>
                                <x-input-label for="name" value="Nama" />
                                <x-text-input id="name" name="name" class="mt-1 block w-full" type="text" 
                                    value="{{ old('name',$userData->name) }}" required />
                            </div>
                            <div>
                                <x-input-label for="email" value="Email" />
                                <x-text-input id="email" name="email" class="mt-1 block w-full" type="text"
                                    value="{{ old('email',$userData->email) }}"/>
                            </div>
                            <div>
                                <input class="border-gray-300 rounded-md" 
                                        type="checkbox" 
                                        value='1'  
                                        name="email_verified_at" 
                                        {{ old('email_verified_at', $userData->email_verified_at) == null ? '' : 'checked' }}
                                />
                                <x-input-label for="email_verified_at" value="verifikasi email" class="inline" />

                            </div>
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    Edit Password
                                </h2>

                                <p class="mt-1 text-sm text-gray-600">
                                    Silakan isikan password baru, jika hendak melakukan
                                    password. Biarkan tetap kosong, jika tidak ingin melakukan perubahan password.
                                </p>
                            </header>
                            <div>
                                <x-input-label for="new_password" value="Password Baru" />
                                <x-text-input id="new_password" name="new_password" value="" type="password"
                                    class="mt-1 block w-full" />
                            </div>
                            <div>
                                <x-input-label for="new_password_confirmation" value="Konfirmasi Password Baru" />
                                <x-text-input id="new_password_confirmation" name="new_password_confirmation" value="" type="password"
                                    class="mt-1 block w-full" />
                            </div>

                            <div class="flex items-center gap-4">
                                <a href="{{ route('member.users.index') }}">
                                    <x-secondary-button>Kembali</x-secondary-button>
                                </a>
                                <x-primary-button>Simpan</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>