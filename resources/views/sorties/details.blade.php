<x-app-layout class="my-8">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' Detail  de la Sorties '. $sortie->nom ) }}
        </h2>
    </x-slot>
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container mx-auto my-8 p-4 py-12 bg-white shadow rounded-lg">
        <h1 class="text-2xl font-bold mb-6">Afficher une sortie</h1>

        <div class="grid grid-cols-2 gap-8 mb-8">
            <!-- Colonne gauche -->
            <div>
                <p class="mb-4"><strong>Nom de la sortie :</strong> {{ $sortie->nom }}</p>
                <p class="mb-4"><strong>Date et heure de la sortie :</strong> {{ $sortie->dateHeureDebut->format('d/m/Y H:i') }}</p>
                <p class="mb-4"><strong>Date limite d'inscription :</strong> {{ $sortie->dateLimiteInscription->format('d/m/Y') }}</p>
                <p class="mb-4"><strong>Nombre de places :</strong> {{ $sortie->nbInscriptionsMax }}</p>
                <p class="mb-4"><strong>Durée :</strong> {{ $sortie->duree }} minutes</p>
                <p class="mb-4"><strong>Description et infos :</strong> {{ $sortie->infosSortie }}</p>
            </div>

            <!-- Colonne droite -->
            <div>
                <p class="mb-4"><strong>Campus :</strong> {{ $sortie->campus->nom }}</p>
                <p class="mb-4"><strong>Lieu :</strong> {{ $sortie->lieu->nom }}</p>
                <p class="mb-4"><strong>Rue :</strong> {{ $sortie->lieu->rue }}</p>
                <p class="mb-4"><strong>Code postal :</strong> {{ $sortie->lieu->codePostal }}</p>
                <p class="mb-4"><strong>Latitude :</strong> {{ $sortie->lieu->latitude }}</p>
                <p class="mb-4"><strong>Longitude :</strong> {{ $sortie->lieu->longitude }}</p>
            </div>
        </div>

        <h2 class="text-xl font-semibold mb-4">Liste des participants inscrits :</h2>
        <div class="overflow-y-auto max-h-48">
            <table class="w-full border border-gray-300 rounded-lg">
                <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border-b border-gray-300 text-left">Pseudo</th>
                    <th class="p-2 border-b border-gray-300 text-left">Nom</th>
                </tr>
                </thead>
                <tbody>
                @foreach($sortie->participants as $participant)
                    <tr class="odd:bg-white even:bg-gray-50">
                        <td class="p-2 border-b border-gray-200">{{ $participant->email }}</td>
                        <td class="p-2 border-b border-gray-200">{{ $participant->prenom }} {{ $participant->nom }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
