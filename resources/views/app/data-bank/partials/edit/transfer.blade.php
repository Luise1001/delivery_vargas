<div id="transfer">
    <form action="{{ route('data.bank.update') }}" method="post">
        @csrf
        @method('PUT')
        <div class="personal-data">
            <input type="hidden" name="type" value="transfer">
            <input type="hidden" name="id" value="{{$data->id}}">
            <label class="form-label" for="bank_id">Bancos<span class="text-danger">*</span></label>
            <select class="form-select" id="bank_id" name="bank_id">
                @foreach ($banks as $bank)
                    @if ($data->bank_id == $bank->id)
                        <option value="{{ $bank->id }}" selected>{{ $bank->name . ' (' . $bank->code . ')' }}
                        </option>
                    @else
                        <option value="{{ $bank->id }}">{{ $bank->name . ' (' . $bank->code . ')' }}</option>
                    @endif
                @endforeach
            </select>
            @error('bank_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <label class="form-label" for="document">Documento de Identidad<span class="text-danger">*</span></label>
            <div class="input-group">
                <select class="form-select" id="document_type" name="document_type">
                    <option value="V" {{ $data->document_type == 'V' ? 'selected' : '' }}>V</option>
                    <option value="J" {{ $data->document_type == 'J' ? 'selected' : '' }}>J</option>
                    <option value="G" {{ $data->document_type == 'G' ? 'selected' : '' }}>G</option>
                    <option value="E" {{ $data->document_type == 'E' ? 'selected' : '' }}>E</option>
                    <option value="P" {{ $data->document_type == 'P' ? 'selected' : '' }}>P</option>
                </select>
                <input class="form-control" type="text" id="document" name="document" value="{{$data->document}}" placeholder="123456789">
                @error('document')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <label class="form-label" for="account_number">Número de Cuenta<span class="text-danger">*</span></label>
            <input class="form-control" type="number" id="account_number" name="account_number" value="{{$data->account_number}}" placeholder="123456789">
            @error('account_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            @error('user_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="container">
                <button  class="save-button">Guardar</button>
            </div>
        </div>
    </form>
</div>
