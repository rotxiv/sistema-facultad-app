<x-layouts.app :title="__('Registro de la bitacora')">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 space-y-4">
        <!-- Tabla Principal -->
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                Bitacora
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                    Historial de la bitacora (acciones realizadas) en el sistema.
                </p>
            </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Usuario</th>
                    <th scope="col" class="px-6 py-3">Descripción</th>
                    <th scope="col" class="px-6 py-3">Fecha Hora</th>
                    <th scope="col" class="px-6 py-3">Registro</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bitacoras as $bitacora)
                <tr id="row-{{ $bitacora->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4">{{ $bitacora->id }}</td>

                    <td class="px-6 py-4">
                        <span class="descripcion-text">{{ $bitacora->user_id ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="descripcion-text">{{ $bitacora->descripcion ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="descripcion-text">{{ $bitacora->fecha_hora ?? '-' }}</span>
                    </td><td class="px-4 py-3">
                        <span class="descripcion-text">{{ $bitacora->registro ?? '-' }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>