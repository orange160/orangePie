<input type="text" id="{{ $name }}" name="{{ $name }}"
       class="form-control @error($name) is-invalid @enderror"
       @if(isset($placeholder)) placeholder="{{ $placeholder }}" @endif
       @if($autofocus ?? false) autofocus @endif
       @if($disabled ?? false) disabled="disabled" @endif
       @if($readonly ?? false) readonly="readonly" @endif
       @if(isset($value) || old($name)) value="{{ old($name) ? old($name) : $value }}" @endif >
@if($errors->has($name))
    <div class="text-danger text-small">{{ $errors->first($name) }}</div>
@endif
