<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Generate PDF From View</title>
</head>
<body>
        <h2 align="center"><big>Artículos del Usuario actual</big></h2>
        <table>
            <thead class="bg-green-50 border-b">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                </tr>
            </thead>
            <tbody>
                {{ $artsUser[0]->descripcion}}
                @if($artsUser != null)
                    @foreach ($artsUser as $artUser)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $artUser->descripcion }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $artUser->precio }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
</body>
</html>