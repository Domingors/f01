<div>
    <div class="py-12  flex items-center justify-between ">
        <div class="max-w-xl mx-auto">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-white-500 rounded shadow overflow-hiden p-4 mb-2">
                    <form class="form-horizontal" method="POST" action="{{ route('importArt_parse') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                            <label for="csv_file" class="border-gray-200 bg-blue-300 hover:gb-blue-500 rounded mb-12">Importar fichero de artículos</label>
                            <div class="mb-2">
                                <input id="csv_file" type="file" class="form-control" name="csv_file" required>
                                @if ($errors->has('csv_file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                                @endif
                                <button type="submit" class="border-gray-200 bg-red-300 hover:gb-red-500 rounded">Procesar fichero</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="bg-white-500 rounded shadow overflow-hiden p-4 mb-2">
                    <form class="form-horizontal" method="POST" action="{{ route('importArtUsr_parse') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                            <label for="csv_file" class="border-gray-200 bg-blue-300 hover:gb-blue-500 rounded mb-4">Importar fichero de artículos de clientes</label>
                            <div class="mb-2">
                                <input id="csv_file" type="file" class="form-control" name="csv_file" required>
                                @if ($errors->has('csv_file'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                                @endif
                                <button type="submit" class="border-gray-200 bg-red-300 hover:gb-red-500 rounded">Procesar fichero</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

