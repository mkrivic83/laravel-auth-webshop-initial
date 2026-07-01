<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Sumarni prikaz kategorija
        </h2>
    </x-slot>

    <div class="py-6">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">

                <div class="p-6">

                    <h3 class="text-lg font-semibold mb-4">

                        Statistika proizvoda po kategorijama

                    </h3>

                    <div class="admin-table-wrapper">

                        <table class="admin-table">

                            <thead>

                                <tr>

                                    <th>ID</th>

                                    <th>Kategorija</th>

                                    <th>Broj proizvoda</th>

                                    <th>Ukupna vrijednost (€)</th>

                                    <th>Minimalna cijena</th>

                                    <th>Maksimalna cijena</th>

                                    <th>Prosječna cijena</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($categories as $category)

                                    <tr>

                                        <td>{{ $category->id }}</td>

                                        <td>{{ $category->naziv }}</td>

                                        <td>

                                            {{ $category->products_count }}

                                        </td>

                                        <td>

                                            {{ number_format($category->products_sum_cijena ?? 0,2,',','.') }}

                                        </td>

                                        <td>

                                            {{ number_format($category->products_min_cijena ?? 0,2,',','.') }}

                                        </td>

                                        <td>

                                            {{ number_format($category->products_max_cijena ?? 0,2,',','.') }}

                                        </td>

                                        <td>

                                            {{ number_format($category->products_avg_cijena ?? 0,2,',','.') }}

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td colspan="7">

                                            Nema podataka.

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                    <div class="mt-6">

                        {{ $categories->links() }}

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>