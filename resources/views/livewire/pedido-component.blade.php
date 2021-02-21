<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="mx-auto mb-6">
                    <div class="bg-white-500 rounded-lb shadow hoverflow-hiden p-4">
                        @if($lPeds != null)
                            <div class="flex flex-col p-2 mx-10">
                                <button wire:click='putEstadoTerminado' type="submmit" class="aling-center border-gray-200 bg-red-500 btn btn-primary" tabindex="10">Cambiar estado</button>
                            </div>
                        @endif
                    </div>
                    <div class="bg-white-500 rounded-lb shadow hoverflow-hiden p-4">
                        <!--
                        <div class="mb-3 display=none">
                            <label for="" class="form-label">Id</label>
                            <input wire:model='lPedido_id' type="text" id="id" name='id' class="form-control" tabindex="1">
                            @error('id')<p>{{ $message }}</p>@enderror
                        </div>
                        -->
                        <div class="mb-3 display=none">
                            <label for="" class="form-label">Pedido_id</label>
                            <input wire:model='pedido_id' type="text" id="pedido_id" name='pedido_id' class="form-control" tabindex="2">
                            @error('pedido_id')<p class="text-xs text-red-500 italic">{{ $message }}</p>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">ArticuloUser_id</label>
                            <input wire:model='articuloUser_id' type="text" id="articuloUser_id" name='articuloUser_id' class="form-control" tabindex="3">
                            @error('articuloUser_id')<p>{{ $message }}</p>@enderror
                        </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Código</label>
                                <input wire:model='codigo' type="text" id="codigo" name='codigo' class="form-control" tabindex="4">
                                @error('codigo')<p>{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Descripcion</label>
                                <input wire:model='descripcion' type="text" id="descripcion"  class="form-control" tabindex="5">
                                @error('descripcion')<p>{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Cantidad</label>
                                <input wire:model='cantidad' type="number" id="cantidad"  class="form-control" tabindex="6">
                                @error('cantidad')<p>{{ $message }}</p>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Precio</label>
                                @error('precio')<p>{{ $message }}</p>@enderror
                                <input wire:model='precio' type="number" id="precio"  step="any" value="0.00" class="form-control" tabindex="7">
                            </div>
            
                            <button wire:click='removeEdit' type="submmit" class="border-gray-200 btn btn-danger" tabindex="8">Cancelar</button>
                            @if($accion=='store')
                                <button wire:click='store' type="submmit" class="border-gray-200 bg-blue-500 btn btn-primary" tabindex="8">Guardar</button>
                            @else
                                <button wire:click='update' type="submmit" class="border-gray-200 bg-green-500 btn btn-primary" tabindex="9">Actualizar</button>
                            @endif
                    
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
                            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                                <input wire:model='busquedaArt' type="text" class="form-input rounded-md shadow-md mt-1 block w-full" placeholder="buscar..."/>
                            </div>
                                    <table class="min-w-full divide-y divide-gray-200" id="articulos">
                                <thead class="bg-blue-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Código
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Descripción
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Precio
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
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
                                                    <a href="#" type="button" wire:click="editArt({{ $art }})" class="bg-yelow">Editar</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
                                @if($lPeds != null)
                                    {{ $lPeds->links() }}
                                @endif
                            </div>
                        </div>
                        <div>
                            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                                <input wire:model='busqueda' type="text" class="form-input rounded-md shadow-md mt-1 block w-full" placeholder="buscar..."/>
                            </div>
                                    <table class="min-w-full divide-y divide-gray-200" id="articulos">
                                <thead class="bg-green-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            PEDIDO_ID
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Código
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Descripción
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Cantidad
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Precio
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @if($lPeds != null)
                                        @foreach ($lPeds as $lped)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $lped->pedido_id }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $lped->codigo }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $lped->descripcion }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $lped->cantidad }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $lped->precio }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <a href="#" type="button" wire:click="edit({{ $lped }})" class="bg-yelow">Editar</a>
                                                    <a href="#" type="button" wire:click='destroy({{ $lped->id }})' class="btn btn-danger bg-red">Borrar</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div>
                                @if($lPeds != null)
                                    {{ $lPeds->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

