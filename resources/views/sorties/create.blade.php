<x-app-layout>
    <div class="container ml-5 mb-0 auto ">
        <h1 class="test-2x font-bold mb-6"> Créer une sortie</h1>

        <x-validation-errors class="mb-4" />
        <!-- Form -->
        <form action="{{ route('sorties.store') }}" method="POST" CLASS="space-y-5 ">
            @csrf

            <div class="grid grid-cols-2 gap-4 justify-stretch">
                <!-- Partie gauche -->
                <div>
                    <label for="nom" class="block text-sm font-semibold mb-1">Nom de la sortie :</label>
                    <input type="text" name="nom" id="nom" class="w-full border border-gray-300 rounded-md p-2">
                    @error('nom')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror

                    <label for="dateHeureDebut" class="block text-sm font-semibold mt-4 mb-1">Date et heure de la sortie :</label>
                    <input type="datetime-local" name="dateHeureDebut" id="dateHeureDebut" class="w-full border border-gray-300 rounded-md p-2">
                    @error('dateHeureDebut')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror


                    <label for="dateLimiteInscription" class="block text-sm font-semibold mt-4 mb-1">Date limite d'inscription :</label>
                    <input type="date" name="dateLimiteInscription" id="dateLimiteInscription" class="w-full border border-gray-300 rounded-md p-2">
                    @error('dateLimiteInscription')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror


                    <label for="nbInscriptionsMax" class="block text-sm font-semibold mt-4 mb-1">Nombre de places :</label>
                    <input type="number" name="nbInscriptionsMax" id="nbInscriptionsMax" class="w-full border border-gray-300 rounded-md p-2">
                    @error('nbInscriptionsMax')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror

                    <label for="duree" class="block text-sm font-semibold mt-4 mb-1">Durée (minutes) :</label>
                    <input type="number" name="duree" id="duree" class="w-full border border-gray-300 rounded-md p-2">
                    @error('duree')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror

                    <label for="infosSortie" class="block text-sm font-semibold mt-4 mb-1">Description et infos :</label>
                    <textarea name="infosSortie" id="infosSortie" rows="4" class="w-full border border-gray-300 rounded-md p-2"></textarea>
                    @error('infosSortie')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <!-- Partie droite -->
                <div>
                    <label for="campus_id" class="block text-sm font-semibold mb-1">Campus :</label>
                    <select name="campus_id" id="campus_id" class="w-full border border-gray-300 rounded-md p-2">
                        @foreach($campusList as $campus)
                            <option value="{{ $campus->id }}">{{ $campus->nom }}</option>
                        @endforeach
                    </select>
                    @error('campus_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror

                    <label for="ville_id" class="block text-sm font-semibold mt-4 mb-1">Ville :</label>
                    <select name="ville_id" id="ville_id" class="w-full border border-gray-300 rounded-md p-2">
                        <option value="">Sélectionnez une ville</option>
                        @foreach($villesList as $ville)
                            <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                        @endforeach
                    </select>
                    @error('ville_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror

                    <label for="lieu_id" class="block text-sm font-semibold mt-4 mb-1">Lieu :</label>
                    <select name="lieu_id" id="lieu_id" class="w-full border border-gray-300 rounded-md p-2" disabled>
                        <option value="">Sélectionnez une ville d'abord</option>
                    </select>
                    @error('lieu_id')
                    <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                    <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded-md mt-2">+</button>


                    <label for="codePostal" class="block text-sm font-semibold mt-4 mb-1">Code postal :</label>
                    <input type="text" name="codePostal" id="codePostal" class="w-full border border-gray-300 rounded-md p-2" disabled>


                    <label for="latitude" class="block text-sm font-semibold mt-4 mb-1">Latitude :</label>
                    <input type="text" name="latitude" id="latitude" class="w-full border border-gray-300 rounded-md p-2" disabled>



                    <label for="longitude" class="block text-sm font-semibold mt-4 mb-1">Longitude :</label>
                    <input type="text" name="longitude" id="longitude" class="w-full border border-gray-300 rounded-md p-2" disabled>
                </div>
            </div>

            <div class="flex space-x-4 my-3 p-4 pb-5 justify-evenly">
                <button type="submit" name="action" value="save" class="bg-green-500 text-white px-6 py-2 rounded-md">Enregistrer</button>
                <button type="submit" name="action" value="publish" class="bg-blue-500 text-white px-6 py-2 rounded-md">Publier la sortie</button>
                <a href="{{ route('sorties.index') }}" class="bg-red-500 text-white px-6 py-2 rounded-md">Annuler</a>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const villeSelect = document.getElementById('ville_id');
            const lieuSelect = document.getElementById('lieu_id');

            //Obtenez les lieux et ville depuis le backend
            const lieuxList = @json($lieuxList);

            villeSelect.addEventListener('change', function(){
                const villeId = this.value;

                lieuSelect.innerHTML = '<option value="">Sélectionnez un lieu </option>';

                if(villeId){
                    const filteredLieux = lieuxList.filter(lieu => lieu.ville.id == villeId);

                    filteredLieux.forEach(lieu => {
                        lieuSelect.innerHTML += `<option value="${lieu.id}">${lieu.nom}</option>`;
                    });

                    lieuSelect.disabled = false;
                }else{
                    lieuSelect.disabled = true;
                }
            })

            lieuSelect.addEventListener('change', function () {
                const lieuId = this.value;
                const lieu = lieuxList.find(l => l.id == lieuId);

                if (lieu) {
                    document.getElementById('codePostal').value = lieu.ville.codePostal || '';
                    document.getElementById('latitude').value = lieu.latitude || '';
                    document.getElementById('longitude').value = lieu.longitude || '';
                } else {
                    document.getElementById('codePostal').value = '';
                    document.getElementById('latitude').value = '';
                    document.getElementById('longitude').value = '';
                }
            });

        });

    </script>
</x-app-layout>
