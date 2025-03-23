@props(['user', 'positions', 'action', 'method'])

<x-form :action="$action" :method="$method" enctype="multipart/form-data" class=" w-96 max-w-full">
  <fieldset class="fieldset">
    <legend class="fieldset-legend">Name</legend>
    <input type="text" class="input w-full @error('name') input-error @enderror" name="name"
      value="{{ old('name', $user->name) }}" />
    @error('name')
      <p class="fieldset-label text-error">{{ $message }}</p>
    @enderror
  </fieldset>

  <fieldset class="fieldset">
    <legend class="fieldset-legend">Profile Photo</legend>
    @if ($user->photo)
      <div class="w-full">
        <img src="{{ $user->photo }}" alt="{{ $user->name }}" class=" w-80 max-w-full p-1 shadow-sm" />
      </div>
    @endif

    <input type="file" class="file-input file-input-primary w-full @error('photo') input-error @enderror"
      name="photo" accept="image/*" />
    @error('photo')
      <p class="fieldset-label text-error">{{ $message }}</p>
    @enderror
  </fieldset>

  <fieldset class="fieldset">
    <legend class="fieldset-legend">Phone</legend>
    <input type="tel" class="input w-full @error('phone') input-error @enderror" name="phone"
      value="{{ old('phone', $user->phone) }}" />
    @error('phone')
      <p class="fieldset-label text-error">{{ $message }}</p>
    @enderror
  </fieldset>

  <fieldset class="fieldset">
    <legend class="fieldset-legend">Email</legend>
    <input type="email" class="input w-full @error('email') input-error @enderror" name="email"
      value="{{ old('email', $user->email) }}" />
    @error('email')
      <p class="fieldset-label text-error">{{ $message }}</p>
    @enderror
  </fieldset>

  <fieldset class="fieldset">
    <legend class="fieldset-legend">Position</legend>
    <select class="select select-primary w-full @error('position_id') select-error @enderror" name="position_id">
      <option disabled selected>Pick a position</option>
      @foreach ($positions as $position)
        <option value="{{ $position->id }}" @selected($position->id == old('position_id', $user->position_id))>{{ $position->name }}</option>
      @endforeach

    </select>
    @error('position_id')
      <p class="fieldset-label text-error">{{ $message }}</p>
    @enderror
  </fieldset>

  <fieldset class="fieldset">
    <legend class="fieldset-legend">Password</legend>
    <input type="password" class="input w-full @error('password') input-error @enderror" name="password" />
    @error('password')
      <p class="fieldset-label text-error">{{ $message }}</p>
    @enderror
  </fieldset>

  <fieldset class="fieldset">
    <legend class="fieldset-legend">Confirm password</legend>
    <input type="password" class="input w-full" name="password_confirmation" />
  </fieldset>

  <button class="btn btn-primary mt-4 w-full">{{ $user->exists ? 'Update' : 'Create' }}</button>
</x-form>
