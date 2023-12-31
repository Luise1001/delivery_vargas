<div id="mobile">
    <form action="{{ route('data.bank.store') }}" method="post">
        @csrf
        <div class="personal-data">
            <input type="hidden" name="type" value="mobile">
            <label class="form-label" for="bank_id">Bancos<span class="text-danger">*</span></label>
            <select class="form-select" id="bank_id" name="bank_id">
                @foreach ($banks as $bank)
                    <option value="{{ $bank->id }}">{{ $bank->name . ' (' . $bank->code . ')' }}</option>
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
                    <option value="V">V</option>
                    <option value="J">J</option>
                    <option value="G">G</option>
                    <option value="E">E</option>
                    <option value="P">P</option>
                </select>
                <input class="form-control" type="text" id="document" name="document" placeholder="123456789">
                @error('document')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <label class="form-label" for="phone">Teléfono<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="phone" name="phone" placeholder="123456789">
            @error('phone')
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
                <button class="save-button">Guardar</button>
            </div>
        </div>
    </form>
</div>
