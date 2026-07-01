<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Upravljanje korisnicima - paginacija
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h3 class="text-lg font-semibold mb-4">
                        Popis korisnika s paginacijom
                    </h3>

                    <div class="admin-table-wrapper">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ime</th>
                                    <th>Email</th>
                                    <th>Admin</th>
                                    <th>Datum rođenja</th>
                                    <th>Plaća</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>

                                        <td>
                                            @if ($user->isAdmin)
                                                <span class="badge-admin">
                                                    DA
                                                </span>
                                            @else
                                                <span class="badge-user">
                                                    NE
                                                </span>
                                            @endif
                                        </td>

                                        <td>
                                            {{ $user->datum_rod?->format('d.m.Y.') }}
                                        </td>

                                        <td>
                                            {{ number_format($user->placa, 2, ',', '.') }} €
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>