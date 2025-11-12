<x-layouts.app :title="__('Lista de Horas')">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 space-y-4">
        @if (session('mensaje'))
            <div id="alert-success" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                <svg class="flex-shrink-0 w-4 h-4 me-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                <span class="sr-only">Success</span>
                <div>
                    {{ session('mensaje') }}
                </div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-success" aria-label="Close">
                    <span class="sr-only">Cerrar</span>
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
        @endif
        <!-- Contenedor de botones -->
        <div class="flex flex-wrap gap-4 mb-4">
            <!-- Botón para añadir asignatura -->
            <button id="open-add-modal-button" data-modal-target="add-subject-modal" data-modal-toggle="add-subject-modal" type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Añadir Hora de clase
            </button>
            <!-- Botón para mostrar asignaturas eliminadas -->
            <form action="" method="GET">
                @csrf
                <button type="submit"class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Horas Eliminadas
                </button>
            </form>
        </div>
        <!-- Modal añadir asignatura -->
        <div id="add-subject-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Ingrese la nueva hora de clases.
                        </h3>
                        <button id="close-add-modal-button" type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="add-subject-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 max-h-[70vh] overflow-y-auto">
                        <form class="space-y-4" action="{{ route('horas.store') }}" method="POST">
                            @csrf
                            <div>
                                <label for="hora_inicio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora de inicio</label>
                                <input type="time" name="hora_inicio" id="hora_inicio" min="07:00" max="20:30" value="00:00" 
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                                
                                <label for="hora_final" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora final</label>
                                <input type="time" name="hora_fin" id="hora_fin" min="08:30" max="22:30" value="00:00"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required />
                                
                                <label for="turno" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Turno</label>
                                <select name="turno" id="turno" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                    <option value="">Seleccione una opción</option>
                                    <option value="Mañana">Mañana</option>
                                    <option value="Tarde">Tarde</option>
                                    <option value="Noche">Noche</option>
                                </select>
                                
                                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear Hora</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin Modal -->
         
        <!-- Tabla Principal -->
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                Lista de Horas
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                    Todos las horas de clases que estan disponibles actualmente.
                </p>
            </caption>
            <thead class="text-xs text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Hora Inicio</th>
                    <th scope="col" class="px-6 py-3">Hora Final</th>
                    <th scope="col" class="px-6 py-3">Turno</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($horas as $hora)
                <form method="POST" action="{{ route('horas.update', $hora->id) }}" id="form-{{ $hora->id }}">
                    @csrf
                    @method('PUT')
                    <tr id="row-{{ $hora->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                        <!-- ID -->
                        <td class="px-4 py-3 align-middle">{{ $hora->id }}</td>

                        <!-- Hora Inicio -->
                        <td class="px-4 py-3 align-middle">
                            <span class="hora_inicio-text">{{ $hora->hora_inicio }}</span>
                            <input type="time" name="hora_inicio" value="{{ $hora->hora_inicio }}"
                                class="hora_inicio-input hidden w-full border rounded px-2 py-1 text-gray-900 dark:bg-gray-600 dark:text-white">
                        </td>

                        <!-- Hora Fin -->
                        <td class="px-4 py-3 align-middle">
                            <span class="hora_fin-text">{{ $hora->hora_fin }}</span>
                            <input type="time" name="hora_fin" value="{{ $hora->hora_fin }}"
                                class="hora_fin-input hidden w-full border rounded px-2 py-1 text-gray-900 dark:bg-gray-600 dark:text-white">
                        </td>

                        <!-- Turno -->
                        <td class="px-4 py-3 align-middle">
                            <span class="turno-text">{{ $hora->turno }}</span>
                            <input type="text" name="turno" value="{{ $hora->turno }}"
                                class="turno-input hidden w-full border rounded px-2 py-1 text-gray-900 dark:bg-gray-600 dark:text-white">
                        </td>

                        <!-- Botones -->
                        <td class="px-6 py-4 text-right">
                            <button type="button"
                                class="editar-btn text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700">
                                Editar
                            </button>

                            <button type="submit"
                                class="guardar-btn hidden text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700">
                                Guardar
                            </button>

                            <button type="button"
                                class="cancelar-btn hidden text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-600 dark:hover:bg-gray-700">
                                Cancelar
                            </button>

                            <form method="POST" action="{{ route('horas.destroy', $hora->id) }}" class="inline-block"
                                onsubmit="return confirm('¿Estás seguro de eliminar esta hora?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                </form>
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
                    fila.querySelector('.hora_inicio-text').classList.add('hidden');
                    fila.querySelector('.hora_fin-text').classList.add('hidden');
                    fila.querySelector('.turno-text').classList.add('hidden');
                    fila.querySelector('.hora_inicio-input').classList.remove('hidden');
                    fila.querySelector('.hora_fin-input').classList.remove('hidden');
                    fila.querySelector('.turno-input').classList.remove('hidden');
                    fila.querySelector('.editar-btn').classList.add('hidden');
                    fila.querySelector('.guardar-btn').classList.remove('hidden');
                    fila.querySelector('.cancelar-btn').classList.remove('hidden');
                });
            });

            document.querySelectorAll('.cancelar-btn').forEach(boton => {
                boton.addEventListener('click', function() {
                    const fila = this.closest('tr');
                    fila.querySelector('.hora_inicio-input').classList.add('hidden');
                    fila.querySelector('.hora_fin-input').classList.add('hidden');
                    fila.querySelector('.turno-input').classList.add('hidden');
                    fila.querySelector('.hora_inicio-text').classList.remove('hidden');
                    fila.querySelector('.hora_fin-text').classList.remove('hidden');
                    fila.querySelector('.turno-text').classList.remove('hidden');
                    fila.querySelector('.editar-btn').classList.remove('hidden');
                    fila.querySelector('.guardar-btn').classList.add('hidden');
                    fila.querySelector('.cancelar-btn').classList.add('hidden');
                });
            });
        });
    </script>
</x-layouts.app>