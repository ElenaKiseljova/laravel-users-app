@props(['action', 'method' => 'POST'])

<form action="{{ $action }}" method="{{ mb_strtolower($method) === 'get' ? 'GET' : 'POST' }}" {{ $attributes }}>
  @csrf

  @unless (in_array(mb_strtolower($method), ['get', 'post']))
    @method(mb_strtoupper($method))
  @endunless

  {{ $slot }}
</form>
