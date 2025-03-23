@if ($message = session('message'))
  <x-alert :text="$message" />
@endif
