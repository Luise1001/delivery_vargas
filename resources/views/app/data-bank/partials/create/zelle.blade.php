<div id="zelle" class="d-none">
    <form action="{{ route('data.bank.store') }}" method="post">
        @csrf
        <div class="personal-data">
            <input type="hidden" name="type" value="zelle">
            <label class="form-label" for="owner_name">Titular<span class="text-danger">*</span></label>
            <input class="form-control" type="text" id="owner_name" name="owner_name" placeholder="Ej. Pedro Perez">
            @error('owner_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <label class="form-label" for="email">Correo Eléctronico<span class="text-danger">*</span></label>
            <input class="form-control" type="email" id="email" name="email" placeholder="Ej. Pedro Pere">
            @error('email')
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
