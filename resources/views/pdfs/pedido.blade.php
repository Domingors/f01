@extends('ppdf')

@section('content')
    <h2 align="center"><big>Artículos del pedido nº: {{$numero}}</big></h2>
    <table>
        <thead class="bg-green-50 border-b">
            <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cantidad</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
            </tr>
        </thead>
        <tbody>
            {{ $artsPedi[0]->descripcion}}
            @if($artsPedi != null)
                @foreach ($artsPedi as $artPedi)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $artPedi->codigo }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $artPedi->descripcion }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $artPedi->cantidad }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $artPedi->precio }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection