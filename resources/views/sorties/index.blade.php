<x-app-layout class="mb-4" >
    <div class="container mx-auto px-4 ">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Liste des sorties</h1>

        <!-- Filtre -->
        <div class="mt-4 p-4 bg-white mb-6">
            <form action="{{ route('sorties.index') }}" method="GET" class="flex flex-wrap items-center justify-around space-y-4 ">
                <!-- Campus Select -->
                <div class="flex flex-col mr-4 w-1/5 min-w-[150px]">
                    <label for="campus" class="text-sm font-semibold mb-1">Campus</label>
                    <select name="campus" id="campus" class="p-2 mb-0 border border-gray-200 rounded-md">
                        <option value="">Tous</option>
                        @foreach($campusList as $campus)
                            <option value="{{ $campus->id }}" {{ request('campus') == $campus->id ? 'selected' : '' }}>{{ $campus->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Date de début -->
                <div class="flex flex-col mr-4 w-1/5 min-w-[150px]">
                    <label for="date_debut" class="text-sm font-semibold mb-1">Entre</label>
                    <input type="date" name="date_debut" id="date_debut" value="{{ request('date_debut') }}" class="p-2 border border-gray-200 rounded-md">
                </div>

                <!-- Date de fin -->
                <div class="flex flex-col mr-4 w-1/5 min-w-[150px]">
                    <label for="date_fin" class="text-sm font-semibold mb-1">et</label>
                    <input type="date" name="date_fin" id="date_fin" value="{{ request('date_fin') }}" class="p-2 border border-gray-200 rounded-md">
                </div>

                <!-- Rechercher Input -->
                <div class="flex flex-col mr-4 w-1/4 min-w-[200px] ">
                    <label for="search" class="text-sm font-semibold mb-1">Nom de la sortie</label>
                    <input type="text" name="search" id="search" placeholder="Rechercher" value="{{ request('search') }}" class="p-2 border border-gray-200 rounded-md">
                </div>

                <!-- Bouton Rechercher -->
                <div class="flex items-center justify-center w-full md:w-auto mt-1">
                    <button type="submit" class="p-2 w-full md:w-auto bg-blue-500 text-white font-semibold rounded-md border border-blue-500 hover:bg-blue-600">
                        Rechercher
                    </button>
                </div>
            </form>
        </div>


        <!-- Tableau des sorties -->
        <div class="overflow-x-auto max-h-96 overflow-y-auto">
            <table class="w-full table-auto">
                <thead>
                <tr class="bg-gray-200 text-gray-700 text-sm uppercase font-semibold">
                    <th class="px-4 py-3 text-left">Nom de la sortie</th>
                    <th class="px-4 py-3 text-left">Date de la sortie</th>
                    <th class="px-4 py-3 text-left">Clôture</th>
                    <th class="px-4 py-3 text-left">Inscrits/Places</th>
                    <th class="px-4 py-3 text-left">État</th>
                    <th class="px-4 py-3 text-left">Inscrit</th>
                    <th class="px-4 py-3 text-left">Organisateur</th>
                    <th class="px-4 py-3 text-left">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-600">
                @foreach($sorties as $sortie)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="px-4 py-3">{{ $sortie->nom }}</td>
                        <td class="px-4 py-3">{{ $sortie->dateHeureDebut->format('d/m/Y H:i') }}</td>
                        <td class="px-4 py-3">{{ $sortie->dateLimiteInscription->format('d/m/Y') }}</td>
                        <td class="px-4 py-3">{{ $sortie->participants ? $sortie->participants->count() : 0 }}/{{ $sortie->nbInscriptionsMax }}</td>
                        <td class="px-4 py-3">{{ $sortie->etat->libelle }}</td>
                        <td class="px-4 py-3">{{ $sortie->participants->contains($user->id) ? 'X' : '' }}</td>
                        <td class="px-4 py-3">{{ $sortie->organisateur->nom }}</td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('sorties.details', $sortie->id) }}" class="text-blue-600 hover:underline">Afficher</a>
                            @if($sortie->participants->contains($user->id))
                                <a href="{{ route('sorties.details', $sortie->id) }}" class="text-red-600 hover:underline">Se désister</a>
                            @else
                                <form action="{{ route('sorties.inscrire', $sortie->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:underline">S'inscrire</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="my-6">
            {{ $sorties->links() }}
        </div>
    </div>
</x-app-layout>
