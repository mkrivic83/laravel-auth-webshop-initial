<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nova kategorija
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form
                        action="{{ route('categories.store') }}"
                        method="POST"
                    >
                        @csrf

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
                                :value="old('naziv')"                               
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
                            >{{ old('opis') }}</textarea>

                            <x-input-error
                                :messages="$errors->get('opis')"
                                class="mt-2"
                            />
                        </div>

                        <div class="flex gap-3">
                            <button
                                type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700"
                            >
                                Spremi
                            </button>

                            <a
                                href="{{ route('categories.index') }}"
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