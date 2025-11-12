<x-layouts.app :title="__('Administrativo')">
<div class="w-full max-w-md mx-auto bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 mt-6">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Contenido del formulario -->
            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                <!-- Cabecera del formulario-->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Ingrese los datos del nuevo administrativo
                    </h3>
                </div>
                <!-- Cuerpo del formulario -->
                <div class="p-4 md:p-5 max-h-[70vh] overflow-y-auto">
                    <form class="space-y-4" action="{{ route('administrativos.update', $administrativo->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        {{-- Datos de Persona --}}
                        <label for="carnet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número de Carnet</label>
                        <input type="text" name="carnet" id="carnet"
                            value="{{ old('carnet', $administrativo->persona->carnet ?? '') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required />

                        <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre y Apellido</label>
                        <input type="text" name="nombre" id="nombre"
                            value="{{ old('nombre', $administrativo->persona->nombre ?? '') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required />

                        <label for="sexo" class="block mt-4 mb-2 text-sm font-medium text-gray-900 dark:text-white">Género</label>
                        <select name="sexo" id="sexo"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                            <option value="">Seleccione una opción</option>
                            <option value="M" {{ old('sexo', $administrativo->persona->sexo ?? '') == 'M' ? 'selected' : '' }}>M - Masculino</option>
                            <option value="F" {{ old('sexo', $administrativo->persona->sexo ?? '') == 'F' ? 'selected' : '' }}>F - Femenino</option>
                        </select>

                        <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono</label>
                        <input type="text" name="telefono" id="telefono"
                            value="{{ old('telefono', $administrativo->persona->telefono ?? '') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required />

                        <label for="direccion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dirección</label>
                        <input type="text" name="direccion" id="direccion"
                            value="{{ old('direccion', $administrativo->persona->direccion ?? '') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required />
                        {{-- Datos del Administrativo --}}
                        <label for="fecha_ingreso" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Ingreso</label>
                        <input type="date" name="fecha_ingreso" id="fecha_ingreso"
                            value="{{ old('fecha_ingreso', $administrativo->fecha_ingreso ?? '') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required />
                        <label for="codigo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Código</label>
                        <input type="text" name="codigo" id="codigo"
                            value="{{ old('codigo', $administrativo->codigo ?? '') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required />
                        <label for="correo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo</label>
                        <input type="email" name="correo" id="correo"
                            value="{{ old('correo', $administrativo->correo ?? '') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg 
                                focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 
                                dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                            required />
                        <button type="submit"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
                                focus:outline-none focus:ring-blue-300 font-medium rounded-lg 
                                text-sm px-5 py-2.5 text-center dark:bg-blue-600 
                                dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Actualizar Administrativo
                        </button>
                    </form>        
                    <!-- Botones de acción -->
                    <div class="flex gap-3 mt-6">
                        <a href="{{ route('administrativos.index') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700">
                            Volver
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>