<x-layouts.app :title="__('Lista de Aulas')">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 space-y-4">
        <!-- Contenedor de botones -->
        <div class="flex flex-wrap gap-4 mb-4">
            <!-- Botón para añadir asignatura -->
            <button id="open-add-modal-button" data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Añadir Aula
            </button>
            <!-- Botón para mostrar asignaturas eliminadas -->
            <form action="{{ route('aulas.deleted-index') }}" method="GET">
                @csrf
                <button type="submit"class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Aulas Eliminadas
                </button>
            </form>
        </div>

        <!-- Modal añadir aula -->
        <div id="add-subject-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Ingrese el nuevo número de Aula
                        </h3>
                        <button id="close-add-modal-button" type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Cerrar modal</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="p-4 md:p-5 max-h-[70vh] overflow-y-auto">
                        <form class="space-y-4" action="{{ route('aulas.store') }}" method="POST">
                            @csrf
                            <div>
                                <!-- Número de aula -->
                                <label for="numero_aula" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número de Aula</label>
                                <input type="number" name="numero_aula" id="numero_aula" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />

                                <!-- Tipo de aula -->
                                <label for="tipo_aula" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de Aula</label>
                                <select name="tipo_aula" id="tipo_aula" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white" required>
                                    <option value="" disabled selected>Seleccione un tipo</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Laboratorio">Laboratorio</option>
                                    <option value="Biblioteca">Biblioteca</option>
                                    <option value="Auditorio">Auditorio</option>
                                </select>

                                <!-- Botón de envío -->
                                <button type="submit" class="mt-6 w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Añadir Aula
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal -->

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                Lista de Aulas Activas
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                    Todas las aulas en las que se imparten clases actualmente.
                </p>
            </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-4 py-3">ID</th>
                    <th scope="col" class="px-4 py-3">Número Aula</th>
                    <th scope="col" class="px-4 py-3">Tipo Aula</th>
                    <th scope="col" class="px-4 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aulas as $aula)
                <tr id="row-{{ $aula->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-4 py-3 align-middle">{{ $aula->id }}</td>
                    <td class="px-4 py-3 align-middle">{{ $aula->numero_aula }}</td>

                    <!-- Campo editable -->
                    <td class="px-4 py-3 align-middle">
                        <span class="descripcion-text">{{ $aula->tipo_aula }}</span>
                        <form method="POST" action="{{ route('aulas.update', $aula->id) }}" class="form-editar hidden mt-2">
                            @csrf
                            @method('PUT')
                            <select name="tipo_aula" class="descripcion-input w-full border rounded px-2 py-1 text-gray-900 dark:bg-gray-600 dark:text-white">
                                @foreach (['Normal', 'Laboratorio', 'Biblioteca', 'Auditorio'] as $tipo)
                                    <option value="{{ $tipo }}" @if($aula->tipo_aula === $tipo) selected @endif>{{ $tipo }}</option>
                                @endforeach
                            </select>
                        </form>
                    </td>

                    <!-- Botones -->
                    <td class="px-4 py-3 align-middle space-x-2">
                        <button type="button" class="editar-btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700">
                            Editar
                        </button>
                        <button type="submit" class="guardar-btn hidden text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-700">
                            Guardar
                        </button>
                        <button type="button" class="cancelar-btn hidden text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-700">
                            Cancelar
                        </button>

                        <!-- Formulario de eliminación -->
                        <form method="POST" action="{{ route('aulas.destroy', $aula->id) }}" class="inline-block ml-2" onsubmit="return confirm('¿Estás seguro de eliminar esta aula?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
    <!-- Script -->
    <script>
        const openAddModalButton = document.getElementById('open-add-modal-button');
        const addModal = document.getElementById('add-subject-modal');
        const closeAddModalButton = document.getElementById('close-add-modal-button');

        openAddModalButton.addEventListener('click', () => {
            addModal.classList.remove('hidden');
            addModal.classList.add('flex');
        });

        closeAddModalButton.addEventListener('click', () => {
            addModal.classList.add('hidden');
            addModal.classList.remove('flex');
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.editar-btn').forEach(boton => {
                boton.addEventListener('click', function() {
                    const fila = this.closest('tr');
                    fila.querySelector('.descripcion-text').classList.add('hidden');
                    fila.querySelector('.form-editar').classList.remove('hidden');
                    fila.querySelector('.editar-btn').classList.add('hidden');
                    fila.querySelector('.guardar-btn').classList.remove('hidden');
                    fila.querySelector('.cancelar-btn').classList.remove('hidden');
                });
            });

            document.querySelectorAll('.cancelar-btn').forEach(boton => {
                boton.addEventListener('click', function() {
                    const fila = this.closest('tr');
                    fila.querySelector('.form-editar').classList.add('hidden');
                    fila.querySelector('.descripcion-text').classList.remove('hidden');
                    fila.querySelector('.editar-btn').classList.remove('hidden');
                    fila.querySelector('.guardar-btn').classList.add('hidden');
                    fila.querySelector('.cancelar-btn').classList.add('hidden');
                });
            });

            document.querySelectorAll('.guardar-btn').forEach(boton => {
                boton.addEventListener('click', function() {
                    const fila = this.closest('tr');
                    fila.querySelector('.form-editar').submit();
                });
            });
        });

    </script>
</x-layouts.app>