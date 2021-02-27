<div class="py-12  flex items-center justify-between ">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="bg-white-500 rounded shadow overflow-hiden p-4">
                    <form class="form-horizontal" method="POST" action="{{ route('importArtUsr_parse') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('csv_file') ? ' has-error' : '' }}">
                                <label for="csv_file" class="col-md-4 control-label">Importador de acrtículos de usuarios</label>

                                <div class="col-md-6">
                                    <input id="csv_file" type="file" class="form-control" name="csv_file" required>

                                    @if ($errors->has('csv_file'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('csv_file') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-danger">
                                        Procesar fichero
                                    </button>
                                </div>
                            </div>
                        </form>
            </div>
        </div>
    </div>
</div>
