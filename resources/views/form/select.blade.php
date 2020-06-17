<select class="custom-select" name="{{ $name }}">
  @foreach($options as $option)
    <option value="{{ $option['value'] }}"
        @if(isset($option['selected'])) selected @endif
    >
        {{ $option['description'] }}
    </option>
  @endforeach
</select>