<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Articulos') }} 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="mx-auto mb-6">
                    <div class="bg-white rounded-lb shadow hoverflow-hiden max-w-4xl p-4">
            
                        <div class="mb-3 display=none">
                            <label for="" class="form-label">Id</label>
                            <input wire:model='lPedido_id' type="text" id="lPedido_id" name='lPedido_id' class="form-control" tabindex="1">
                        </div>
                        <div class="mb-3 display=none">
                            <label for="" class="form-label">Pedido_id</label>
                            <input wire:model='pedido_id' type="text" id="pedido_id" name='pedido_id' class="form-control" tabindex="2">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">ArticuloUser_id</label>
                            <input wire:model='articuloUser_id' type="text" id="articuloUser_id" name='articuloUser_id' class="form-control" tabindex="3">
                        </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Código</label>
                                <input wire:model='codigo' type="text" id="codigo" name='codigo' class="form-control" tabindex="4">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Descripcion</label>
                                <input wire:model='descripcion' type="text" id="descripcion"  class="form-control" tabindex="5">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Cantidad</label>
                                <input wire:model='cantidad' type="number" id="cantidad"  class="form-control" tabindex="6">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Precio</label>
                                <input wire:model='precio' type="number" id="precio"  step="any" value="0.00" class="form-control" tabindex="7">
                            </div>
            
                            <a href="Pedidos" class="btn btn-secondary" tabindex="8">Cancelar</a>
                            <button wire:click='store' type="submmit" class="btn btn-primary" tabindex="9">Guardar</button>
                    
                    
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
                        <input wire:model='busqueda' type="text" class="form-input rounded-md shadow-md mt-1 block w-full" placeholder="buscar..."/>
                    </div>
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        <table class="min-w-full divide-y divide-gray-200" id="articulos">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        PEDIDO_ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ARTICULO_ID
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
                                @foreach ($lPedidos as $lpedi)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $lpedi->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $lpedi->pedido_id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $lpedi->articuloUser_id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $lpedi->codigo }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $lpedi->descripcion }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $lpedi->cantidad }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $lpedi->precio }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="#" type="button" wire:click="edit({{ $lpedi }})" class="btn btn-info">Editar</a>
                                            <a href="#" type="button" wire:click='destroy({{ $lpedi->id }})' class="btn btn-danger">Borrar</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

