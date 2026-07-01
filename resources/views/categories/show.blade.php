<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalji kategorije
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <table class="admin-table">
                        <tr>
                            <th>ID</th>
                            <td>{{ $category->id }}</td>
                        </tr>

                        <tr>
                            <th>Naziv</th>
                            <td>{{ $category->naziv }}</td>
                        </tr>

                        <tr>
                            <th>Opis</th>
                            <td>{{ $category->opis }}</td>
                        </tr>

                        <tr>
                            <th>Kreirano</th>
                            <td>{{ $category->created_at?->format('d.m.Y. H:i') }}</td>
                        </tr>

                        <tr>
                            <th>Ažurirano</th>
                            <td>{{ $category->updated_at?->format('d.m.Y. H:i') }}</td>
                        </tr>
                    </table>

                    <div class="mt-6 flex gap-3">
                        <a
                            href="{{ route('categories.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                        >
                            Povratak
                        </a>

                        @can('admin-access')
                            <a
                                href="{{ route('categories.edit', $category) }}"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                            >
                                Uredi
                            </a>
                        @endcan
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>