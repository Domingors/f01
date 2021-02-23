<div>
    <div class="py-12  flex items-center justify-between ">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-white-500 rounded shadow overflow-hiden p-4">
                    <div class="mb-3" style="display:none">
                        <label for="" class="form-label">Id</label>
                        <input wire:model='idArt' type="text" id="id" name='id' class="form-label" tabindex="1">
                        @error('id')<p>{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Código</label>
                        <input wire:model='codigo' id="codigo" name='codigo' type="text" class="form-control"/>
                        @error('codigo')<p>{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Descripcion</label>
                        <input wire:model='descripcion' id="descripcion" type="text" class="form-control"/>
                        @error('descripcion')<p>{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Precio</label>
                        <input wire:model='precio' id="precio"  type="number" step="any" value="0.00" class="form-control"/>
                        @error('precio')<p>{{ $message }}</p>@enderror
                    </div>
                    
                    <div class="bg-gray-100 flex p-2  flex items-center justify-between">
                        <div class="align=left">
                            <button wire:click='removeEdit' type="submmit" class="border-gray-200 bg-red-100 hover:gb-red-300 rounded" tabindex="8">Cancelar</button>
                        </div>
                        <div class="align=right">
                            @if($accion=='store')
                                <button wire:click='store' type="submmit" class="border-gray-200 bg-blue-300 hover:gb-blue-500 rounded" tabindex="8">Guardar</button>
                            @else
                                <button wire:click='update' type="submmit" class="border-gray-200 bg-green-300 hover:gb-green-500 rounded" tabindex="9">Actualizar</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto">
        <div class="bg-gray-50 px-4 py-3 border border-gray-200">
            <div class="bg-white px-4 py-3 border border-gray-200">
                <h2 align="center"><big>Artículos generales</big></h2>
                <div class="bg-white py-2">
                    <input wire:model='busquedaArt' type="text" class="form-input rounded-md shadow-md mt-1 block w-full" placeholder="buscar..."/>
                </div>
                <table class="min-w-full divide-y divide-gray-200" id="articulos">
                    <thead class="bg-green-50 border-b">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if($arts != null)
                            @foreach ($arts as $art)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $art->codigo }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $art->descripcion }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $art->precio }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="#" type="button" wire:click="edit({{ $art }})" class="bg-green-300 hover:gb-green-700 rounded">Editar</a>
                                        <a href="#" type="button" wire:click='destroy({{ $art->id }})' class="bg-red-300 hover:gb-red-700 rounded">Borrar</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $arts->links() }}
            </div>
        </div>
    </div>
</div>