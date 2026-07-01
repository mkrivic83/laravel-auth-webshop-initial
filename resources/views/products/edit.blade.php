<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Uređivanje proizvoda
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form
                        action="{{ route('products.update', $product) }}"
                        method="POST"
                    >
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label
                                for="category_id"
                                value="Kategorija"
                            />

                            <select
                                id="category_id"
                                name="category_id"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                required
                            >
                                @foreach ($categories as $category)
                                    <option
                                        value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->naziv }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error
                                :messages="$errors->get('category_id')"
                                class="mt-2"
                            />
                        </div>

                        <div class="mb-4">
                            <x-input-label
                                for="naziv"
                                value="Naziv"
                            />

                            <x-text-input
                                id="naziv"
                                name="naziv"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('naziv', $product->naziv)"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('naziv')"
                                class="mt-2"
                            />
                        </div>

                        <div class="mb-4">
                            <x-input-label
                                for="opis"
                                value="Opis"
                            />

                            <textarea
                                id="opis"
                                name="opis"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                rows="4"
                            >{{ old('opis', $product->opis) }}</textarea>

                            <x-input-error
                                :messages="$errors->get('opis')"
                                class="mt-2"
                            />
                        </div>

                        <div class="mb-4">
                            <x-input-label
                                for="cijena"
                                value="Cijena"
                            />

                            <x-text-input
                                id="cijena"
                                name="cijena"
                                type="number"
                                step="0.01"
                                class="mt-1 block w-full"
                                :value="old('cijena', $product->cijena)"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('cijena')"
                                class="mt-2"
                            />
                        </div>

                        <div class="mb-4">
                            <x-input-label
                                for="kolicina"
                                value="Količina"
                            />

                            <x-text-input
                                id="kolicina"
                                name="kolicina"
                                type="number"
                                class="mt-1 block w-full"
                                :value="old('kolicina', $product->kolicina)"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('kolicina')"
                                class="mt-2"
                            />
                        </div>

                        <div class="flex gap-3">
                            <button
                                type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                            >
                                Spremi promjene
                            </button>

                            <a
                                href="{{ route('products.index') }}"
                                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600"
                            >
                                Odustani
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>