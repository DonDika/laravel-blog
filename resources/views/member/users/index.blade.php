<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pengaturan Users 
            <a class="bg-blue-400 p-2 rounded-md text-white text-sm " href="">
                Add User
            </a>
        </h2>
    </x-slot>
    <x-slot name="headerRight">
        <form method="get" action="{{ route('member.users.index') }}">
            <x-text-input id="search" name="search" type="text" class="p-1 m-0 md:w-72 w-80 mt-3 md:mt-0"
                placeholder="masukkan kata kunci..." value="{{ request('search') }}" />
            <x-secondary-button class="p-1" type="submit">cari</x-secondary-button>
        </form>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap table-fixed">
                        <!-- nama kolom -->
                        <thead>
                            <tr class="text-center font-bold">
                                <td class="border px-6 py-4 w-[80px]">No</td>
                                <td class="border px-6 py-4">Nama</td>
                                <td class="border px-6 py-4 lg:w-[250px] hidden lg:table-cell">Waktu Daftar</td>
                                <td class="border px-6 py-4 lg:w-[120px] hidden lg:table-cell">Verifikasi Email</td>
                                <td class="border px-6 py-4 lg:w-[120px] hidden lg:table-cell">Block</td>
                                <td class="border px-6 py-4 lg:w-[200px] w-[100px]">Aksi</td>
                            </tr>
                        </thead>

                        <!-- isian kolom, di-looping -->
                        <tbody>
                            @foreach ($userData as $key => $value)
                                <tr>
                                    <td class="border px-6 py-4">
                                        {{ $userData->firstItem() + $key }}
                                    </td>

                                    <td class="border px-6 py-4">
                                        <div>{{ $value->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $value->email }}</div>
                                        <div class="block lg:hidden text-sm text-gray-500">
                                            {{ $value->created_at->isoFormat('dddd, D MMMM Y') }}
                                            | verifikasi email: {{ $value->email_verified_at != null ? 'sudah' : '-' }}
                                        </div>
                                        <div class="block lg:hidden text-sm text-gray-500">
                                            Block:
                                            <a href="{{ route('member.users.toggle-block', ['user' => $value->id]) }}">
                                                @if ($value->blocked_at == null)
                                                    <span class="text-blue-600">tidak</span>
                                                @else
                                                    <span class="text-red-600">ya</span>
                                                @endif
                                            </a>
                                        </div>
                                    </td>

                                    <td class="border px-6 py-4 text-gray-500 text-sm text-center hidden lg:table-cell">
                                        {{ $value->created_at->isoFormat('dddd, D MMMM Y') }}
                                    </td>

                                    <td class="border px-6 py-4 text-gray-500 text-sm text-center hidden lg:table-cell">
                                        {{ $value->email_verified_at != null ? 'sudah' : '-' }}
                                    </td>

                                    <td class="border px-6 py-4 text-gray-500 text-sm text-center hidden lg:table-cell">
                                        <a href="{{ route('member.users.toggle-block', parameters: ['user' => $value->id]) }}">
                                            @if ($value->blocked_at == null)
                                                <span class="text-blue-600">tidak</span>
                                            @else
                                                <span class="text-red-600">ya</span>
                                            @endif
                                        </a>
                                    </td>

                                    <td class="border px-6 py-4 text-center">
                                        <a class="text-blue-600 hover:text-blue-400 px-2"
                                            href="{{ route('member.users.edit', ['user' => $value->id]) }}">
                                            edit
                                        </a>
                                        <form class="inline" method="POST"
                                            onsubmit="return confirm('Yakin mau hapus data ini?')"
                                            action="{{ route('member.users.destroy', ['user' => $value->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type='submit' class='text-red-600 hover:text-red-400 px-2'>
                                                hapus
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-5">
                    {{ $userData->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>