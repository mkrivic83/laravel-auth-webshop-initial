<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pretraga proizvoda
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form
                        action="{{ route('products.search') }}"
                        method="GET"
                        class="mb-6"
                    >
                        <div class="flex gap-3 items-end">

                            <div class="flex-1">
                                <label
                                    for="search"
                                    class="block font-semibold mb-1"
                                >
                                    Pretraga po nazivu proizvoda ili kategoriji
                                </label>

                                <input
                                    id="search"
                                    type="text"
                                    name="search"
                                    value="{{ $search }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm"
                                    placeholder="npr. laptop, mobiteli, monitor..."
                                >
                            </div>

                            <button
                                type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                            >
                                <i class="bi bi-search"></i>
                                Pretraži
                            </button>

                            <a
                                href="{{ route('products.search') }}"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                            >
                                Reset
                            </a>

                        </div>
                    </form>

                    <div class="admin-table-wrapper">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Naziv</th>
                                    <th>Kategorija</th>
                                    <th>Cijena</th>
                                    <th>Količina</th>
                                    <th>Detalji</th>

                                    @can('admin-access')
                                        <th>Akcije</th>
                                    @endcan
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $product->id }}</td>

                                        <td>{{ $product->naziv }}</td>

                                        <td>{{ $product->category->naziv }}</td>

                                        <td>
                                            {{ number_format($product->cijena, 2, ',', '.') }} €
                                        </td>

                                        <td>{{ $product->kolicina }}</td>

                                        <td>
                                            <a
                                                href="{{ route('products.show', $product) }}"
                                                class="icon-button icon-edit"
                                                title="Detalji"
                                            >
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </td>

                                        @can('admin-access')
                                            <td>
                                                <div class="action-buttons">
                                                    <a
                                                        href="{{ route('products.edit', $product) }}"
                                                        class="icon-button icon-edit"
                                                        title="Uredi"
                                                    >
                                                        <i class="bi bi-pencil-square"></i>
                                                    </a>

                                                    <form
                                                        action="{{ route('products.destroy', $product) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Obrisati proizvod?')"
                                                    >
                                                        @csrf
                                                        @method('DELETE')

                                                        <button
                                                            type="submit"
                                                            class="icon-button icon-delete"
                                                            title="Obriši"
                                                        >
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            Nema pronađenih proizvoda za zadani pojam.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $products->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>