<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            DummyJSON proizvodi
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form
                        action="{{ route('dummy-products.index') }}"
                        method="GET"
                        class="mb-6"
                    >
                        <div class="flex gap-3 items-end">
                            <div class="flex-1">
                                <label
                                    for="search"
                                    class="block font-semibold mb-1"
                                >
                                    Pretraga po nazivu proizvoda
                                </label>

                                <input
                                    id="search"
                                    type="text"
                                    name="search"
                                    value="{{ $search }}"
                                    class="w-full rounded-md border-gray-300 shadow-sm"
                                    placeholder="npr. laptop, phone, beauty..."
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
                                href="{{ route('dummy-products.index') }}"
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
                                    @can('admin-access')
                                        <th>Status</th>
                                    @endcan
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($products as $product)
                                    <tr>
                                        <td>{{ $product['id'] }}</td>
                                        <td>{{ $product['title'] }}</td>
                                        <td>{{ $product['category'] }}</td>

                                        <td>
                                            {{ number_format($product['price'], 2, ',', '.') }} €
                                        </td>

                                        <td>{{ $product['stock'] }}</td>
                                        @can('admin-access')
                                        <td>
                                            @if ($product['saved'])
                                                <span class="badge-admin">
                                                    Spremljeno
                                                </span>
                                            @else
                                                <form
                                                    action="{{ route('dummy-products.store') }}"
                                                    method="POST"
                                                >
                                                    @csrf

                                                    <input
                                                        type="hidden"
                                                        name="title"
                                                        value="{{ $product['title'] }}"
                                                    >

                                                    <input
                                                        type="hidden"
                                                        name="description"
                                                        value="{{ $product['description'] }}"
                                                    >

                                                    <input
                                                        type="hidden"
                                                        name="price"
                                                        value="{{ $product['price'] }}"
                                                    >

                                                    <input
                                                        type="hidden"
                                                        name="stock"
                                                        value="{{ $product['stock'] }}"
                                                    >

                                                    <input
                                                        type="hidden"
                                                        name="category"
                                                        value="{{ $product['category'] }}"
                                                    >

                                                    <input
                                                        type="hidden"
                                                        name="search"
                                                        value="{{ request('search') }}"
                                                    >

                                                    <input
                                                        type="hidden"
                                                        name="page"
                                                        value="{{ request('page') }}"
                                                    >

                                                    <button
                                                        type="submit"
                                                        class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700"
                                                    >
                                                        Spremi
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    @endcan
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">
                                            Nema pronađenih proizvoda.
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