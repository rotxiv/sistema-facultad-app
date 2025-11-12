<x-layouts.app :title="__('Materias Asignadas')">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <!-- Contenedor de botones -->
        <div class="flex flex-wrap gap-4 mb-4">
            <form action="{{ route('docentes.index') }}" method="GET">
                @csrf
                <button type="submit"class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Volver
                </button>
            </form>
        </div>
        <!-- Tabla Principal -->
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                Lista de Materias Asignadas
                <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                    Las materias que tiene asignadas el docente {{ $docente }}.
                </p>
            </caption>
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Sigla</th>
                    <th scope="col" class="px-6 py-3">Asignatura</th>
                    <th scope="col" class="px-6 py-3">Grupo</th>
                    <th scope="col" class="px-6 py-3">Semestre</th>
                    <th scope="col" class="px-6 py-3">Observacion</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($asignaciones as $asignacion)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <td class="px-6 py-4">
                        {{$asignacion->asignatura->sigla ?? '—' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $asignacion->asignatura->descripcion ?? '—' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $asignacion->grupo->descripcion ?? '—' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $asignacion->semestre->descripcion ?? '—' }}
                    </td>
                    <td class="px-6 py-4">
                        {{$asignacion->observacion ?? '—' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>