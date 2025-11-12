<x-layouts.app :title="__('Lista de aulas eliminadas')">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 space-y-4">
        <form action="{{ route('aulas.index') }}" method="GET">
            @csrf
            <button type="submit"class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Regresar
            </button>
        </form>
        <!-- Tabla Principal -->
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                Lista de Aulas Eliminados
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                    Todas las Aulas que han sido retirados actualmente.
                </p>
            </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Número Aula</th>
                    <th scope="col" class="px-6 py-3">Tipo Aula</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aulas as $aula)
                <tr id="row-{{ $aula->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $aula->id }}</td>

                    <td class="px-6 py-4">
                        <span class="descripcion-text">{{ $aula->numero_aula ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="descripcion-text">{{ $aula->tipo_aula ?? '-' }}</span>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <!-- Formulario de reactivacion -->
                        <form action="{{ route('aulas.reactivar', $aula->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 dark:bg-red-700 dark:hover:bg-red-800">
                                Reactivar
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>