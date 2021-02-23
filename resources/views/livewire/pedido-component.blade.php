<div>
    <div class="py-12  flex items-center justify-between ">
        <div class="max-w-2xl mx-auto">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex">
                <div class="bg-white-500 rounded-lb shadow hoverflow-hiden p-4">
                    <div class="mb-3" style="display:none">
                        <label for="" class="form-label">Id</label>
                        <input wire:model='lPedido_id' type="text" id="id" name='id' class="form-label" tabindex="1">
                        @error('id')<p>{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-3" style="display:none">
                        <label for="" class="form-label">Pedido_id</label>
                        <label wire:model='pedido_id' id="pedido_id" name='pedido_id' class="form-label">{{ $pedido_id }}</label>
                        @error('pedido_id')<p class="text-xs text-red-500 italic">{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-3" style="display:none">
                        <label for="" class="form-label">ArticuloUser_id</label>
                        <label wire:model='articuloUser_id' id="articuloUser_id" name='articuloUser_id' class="form-label">{{ $articuloUser_id }}</label>
                        @error('articuloUser_id')<p>{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-3" style="display:none">
                        <label for="" class="form-label">Código</label>
                        <label wire:model='codigo' id="codigo" name='codigo' class="form-label">{{ $codigo }}</label>
                        @error('codigo')<p>{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label" style="display:none">Descripcion</label>
                        <label wire:model='descripcion' id="descripcion"  class="form-label">{{ $descripcion }}</label>
                        @error('descripcion')<p>{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Cantidad</label>
                        <input wire:model='cantidad' type="number" id="cantidad"  class="form-control" tabindex="6">
                        @error('cantidad')<p>{{ $message }}</p>@enderror
                    </div>
                    <div class="mb-3" style="display:none">
                        <label for="" class="form-label">Precio</label>
                        <label wire:model='precio' id="precio"  step="any" value="0.00" class="form-label">{{ $precio }}</label>
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
                <div class="bg-white-500 rounded-lb shadow overflow-hiden p-4">
                    @if($lPeds != null)
                        <div class="flex flex-col p-2 mx-10">
                            <button wire:click='putEstadoTerminado' type="submmit" class="aling-center border-gray-200 bg-red-300 hover:gb-red-500 rounded" tabindex="10">Marcar como terminado</button>
                        </div>
                        <div class="flex flex-col p-2 mx-10">
                            <label id="nºpedido"  class="form-label">Pedido nº {{ $idCabPed }}</label>
                        </div>
                        <div class="flex flex-col p-2 mx-10">
                            <label id="importe"  class="form-label">Importe {{ $importe }}</label>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container mx-auto">
        <div class="bg-gray-50 px-4 py-3 flex justify-between border border-gray-200">
            <div class="bg-white px-4 py-3 border border-gray-200">
                <h2 align="center"><big>Artículos que puede pedir</big></h2>
                <div class="bg-white py-2">
                    <input wire:model='busquedaArt' type="text" class="form-input rounded-md shadow-md mt-1 block w-full" placeholder="buscar..."/>
                </div>
                <table class="min-w-full divide-y divide-gray-200" id="articulosUser">
                    <thead class="bg-blue-50 border-b">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Accion</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if($arts != null)
                            @foreach ($arts as $art)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $art->descripcion }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $art->precio }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="#" type="button" wire:click="editArt({{ $art }})" class="bg-blue-300 hover:gb-blue-500 rounded">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="bg-white px-4 py-3 border border-gray-200">
                <h2 align="center"><big>Artículos del pedido actual</big></h2>
                <div class="bg-white py-2">
                    <input wire:model='busqueda' type="text" class="form-input rounded-md shadow-md mt-1 block w-full" placeholder="buscar..."/>
                </div>
                <table class="min-w-full divide-y divide-gray-200" id="articulosPedido">
                    <thead class="bg-green-50 border-b">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if($lPeds != null)
                            @foreach ($lPeds as $lped)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $lped->descripcion }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $lped->cantidad }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $lped->precio }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="#" type="button" wire:click="edit({{ $lped }})" class="bg-green-300 hover:gb-green-700 rounded">Editar</a>
                                        <a href="#" type="button" wire:click='destroy({{ $lped->id }})' class="bg-red-300 hover:gb-red-700 rounded">Borrar</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

