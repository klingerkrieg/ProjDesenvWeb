<div class="row mb-3">
    <label for="cep" class="col-md-4 col-form-label text-md-end">
        {{ __('CEP') }}</label>

    <div class="col-md-6">
        <input id="cep" type="text"
                class="form-control @error('cep') is-invalid @enderror cep"
                name="cep" value="{{ old('cep',!empty($data->address) ? $data->address->cep : '') }}"
                autofocus>

        @error('cep')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="street" class="col-md-4 col-form-label text-md-end">
        {{ __('Logradouro') }}</label>

    <div class="col-md-6">
        <input id="street" type="text"
                class="form-control @error('street') is-invalid @enderror"
                name="street" value="{{ old('street',!empty($data->address) ? $data->address->street : '') }}"
                autofocus>

        @error('street')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


<div class="row mb-3">
    <label for="number" class="col-md-4 col-form-label text-md-end">
        {{ __('Numero') }}</label>

    <div class="col-md-6">
        <input id="number" type="text"
                class="form-control @error('number') is-invalid @enderror"
                name="number" value="{{ old('number',!empty($data->address) ? $data->address->number : '') }}"
                autofocus>

        @error('number')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="row mb-3">
    <label for="complement" class="col-md-4 col-form-label text-md-end">
        {{ __('Complemento') }}</label>

    <div class="col-md-6">
        <input id="complement" type="text"
                class="form-control @error('complement') is-invalid @enderror"
                name="complement" value="{{ old('complement',!empty($data->address) ? $data->address->complement : '') }}"
                autofocus>

        @error('complement')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


<div class="row mb-3">
    <label for="district" class="col-md-4 col-form-label text-md-end">
        {{ __('Bairro') }}</label>

    <div class="col-md-6">
        <input id="district" type="text"
                class="form-control @error('district') is-invalid @enderror"
                name="district" value="{{ old('district',!empty($data->address) ? $data->address->district : '') }}"
                autofocus>

        @error('district')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>




<div class="row mb-3">
    <label for="city" class="col-md-4 col-form-label text-md-end">
        {{ __('Localidade') }}</label>

    <div class="col-md-6">
        <input id="city" type="text"
                class="form-control @error('city') is-invalid @enderror"
                name="city" value="{{ old('city',!empty($data->address) ? $data->address->city : '') }}"
                autofocus>

        @error('city')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>



<div class="row mb-3">
    <label for="state" class="col-md-4 col-form-label text-md-end">
        {{ __('UF') }}</label>

    <div class="col-md-6">
        <input id="state" type="text"
                class="form-control @error('state') is-invalid @enderror"
                name="state" value="{{ old('state',!empty($data->address) ? $data->address->state : '') }}"
                autofocus>

        @error('state')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
