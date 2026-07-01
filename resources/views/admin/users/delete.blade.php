<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Brisanje korisnika
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h3 class="text-lg font-semibold text-red-600 mb-6">
                        Jeste li sigurni da želite obrisati korisnika?
                    </h3>

                    <table class="admin-table">

                        <tr>
                            <th>ID</th>
                            <td>{{ $user->id }}</td>
                        </tr>

                        <tr>
                            <th>Ime</th>
                            <td>{{ $user->name }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>

                        <tr>
                            <th>Datum rođenja</th>
                            <td>
                                {{ $user->datum_rod?->format('d.m.Y.') }}
                            </td>
                        </tr>

                        <tr>
                            <th>Plaća</th>
                            <td>
                                {{ number_format($user->placa, 2, ',', '.') }} €
                            </td>
                        </tr>

                    </table>

                    <div class="mt-6 flex gap-4">

                        <a href="{{ route('admin.users.index') }}"
                           class="bg-gray-500 text-white px-4 py-2 rounded">

                            Odustani

                        </a>

                        <form
                            action="{{ route('admin.users.destroy', $user) }}"
                            method="POST"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="bg-red-600 text-white px-4 py-2 rounded"
                            >
                                Obriši korisnika
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>