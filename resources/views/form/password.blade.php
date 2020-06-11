<input type="password" id="{{ $name }}" name="{{ $name }}"
       class="form-control @error($name) is-invalid @enderror"
        @if(isset($placeholder)) placeholder="{{ $placeholder }}" @endif
        @if(old($name)) value="{{ old($name) }}" @endif>
@if($errors->has($name))
    <div class="text-danger text-small">{{ $errors->first($name) }}</div>
@endif