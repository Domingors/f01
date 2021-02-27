<div>
    <div class="py-12  flex items-center justify-between ">
        @if($isAdmin)
            <div class="max-w-2xl mx-auto">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex">
                    <div class="bg-white-500 rounded-lb shadow hoverflow-hiden p-4">
                        <div class="form-group">
                            <h2>Usuarios</h2>
                            <select wire:model="idUser" class="form-control" name="idUser" required >
                                @foreach($users as $user)
                                    <option  value="{{$user->id}}"> {{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="bg-white-500 rounded-lb shadow overflow-hiden p-4">
                        <div class="form-group">
                            <h2>Estados</h2>
                            <select wire:model="estado" class="form-control" name="estado" required >
                                @foreach($estads as $estad)
                                    <option  value="{{$estad[0]}}"> {{$estad[1]}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        @else
        <div class="max-w-1xl mx-auto">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg flex">
                <div class="bg-white-500 rounded-lb shadow overflow-hiden p-4">
                    <div class="form-group">
                        <h2>Estados</h2>
                        <select wire:model="estado" class="form-control" name="estado" required >
                            @foreach($estads as $estad)
                                <option  value="{{$estad[0]}}"> {{$estad[1]}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
    <div class="container mx-auto">
        <div class="bg-gray-50 px-4 py-3 border border-gray-200">
            <div class="bg-white px-4 py-3 border border-gray-200">
                <h2 align="center"><big>Pendiente de servir</big></h2>
                <table class="min-w-full divide-y divide-gray-200" id="articulos">
                    <thead class="bg-green-50 border-b">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Id</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Usuario</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if($cPeds != null)
                            @foreach ($cPeds as $cPed)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cPed->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cPed->user_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $cPed->estado }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="#" type="button" wire:click="putEstadoIncompleto({{ $cPed->id }})" class="bg-green-100 hover:gb-green-700 rounded">Marcar incompleto</a>
                                        <a href="#" type="button" wire:click="putEstadoTerminado({{ $cPed->id }})" class="bg-green-300 hover:gb-green-700 rounded">Marcar terminado</a>
                                        @if($isAdmin)
                                                <a href="#" type="button" wire:click="putEstadoEntregado({{ $cPed->id }})" class="bg-green-200 hover:gb-green-700 rounded">Marcar entregado</a>
                                        @endif
                                        <a href="#" type="button" wire:click='makePdf({{ $cPed->id }})' class="bg-blue-300 hover:gb-blue-700 rounded">Generar pdf</a>
                                        @if($isAdmin)
                                            <a href="#" type="button" wire:click='destroy({{ $cPed->id }})' class="bg-red-300 hover:gb-red-700 rounded">Borrar</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                {{ $cPeds->links() }}
            </div>
        </div>
    </div>
</div>