<x-app-layout>

    <x-slot name="header">

        <h2>

            Greška 403

        </h2>

    </x-slot>

    <div class="error-container">

        <div class="error-box">

            <h3 class="error-title">

                Nemate pravo pristupa.

            </h3>

            <p class="error-text">

                Ovaj dio aplikacije dostupan je samo
                ovlaštenim korisnicima.

            </p>

            <a
                href="{{ route('dashboard') }}"
                class="note-button"
            >

                Povratak na Dashboard

            </a>

        </div>

    </div>

</x-app-layout>