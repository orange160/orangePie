<textarea type="text" id="{{ $name }}" name="{{ $name }}" rows="5"
       class="form-control @error($name) is-invalid @enderror"
          @if(isset($value) || old($name)) value="{{ old($name) ? old($name) : $value }}" @endif ></textarea>
@if($errors->has($name))
    <div class="text-danger text-small">{{ $errors->first($name) }}</div>
@endif
