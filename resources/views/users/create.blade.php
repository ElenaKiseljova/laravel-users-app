<x-layout title="Create User Page">
  <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data" class=" max-w-fit">
    @csrf

    <fieldset class="fieldset">
      <legend class="fieldset-legend">Name</legend>
      <input type="text" class="input @error('name') input-error @enderror" name="name"
        value="{{ old('name') }}" />
      @error('name')
        <p class="fieldset-label text-error">{{ $message }}</p>
      @enderror
    </fieldset>

    <fieldset class="fieldset">
      <legend class="fieldset-legend">Profile Photo</legend>
      <input type="file" class="file-input file-input-primary @error('photo') input-error @enderror" name="photo"
        accept="image/*" />
      @error('photo')
        <p class="fieldset-label text-error">{{ $message }}</p>
      @enderror
    </fieldset>

    <fieldset class="fieldset">
      <legend class="fieldset-legend">Phone</legend>
      <input type="tel" class="input @error('phone') input-error @enderror" name="phone"
        value="{{ old('phone') }}" />
      @error('phone')
        <p class="fieldset-label text-error">{{ $message }}</p>
      @enderror
    </fieldset>

    <fieldset class="fieldset">
      <legend class="fieldset-legend">Email</legend>
      <input type="email" class="input @error('email') input-error @enderror" name="email"
        value="{{ old('email') }}" />
      @error('email')
        <p class="fieldset-label text-error">{{ $message }}</p>
      @enderror
    </fieldset>

    <fieldset class="fieldset">
      <legend class="fieldset-legend">Position</legend>
      <select class="select select-primary @error('position_id') select-error @enderror" name="position_id">
        <option disabled selected>Pick a position</option>
        @foreach ($positions as $position)
          <option value="{{ $position->id }}" @selected($position->id == old('position_id'))>{{ $position->name }}</option>
        @endforeach

      </select>
      @error('position_id')
        <p class="fieldset-label text-error">{{ $message }}</p>
      @enderror
    </fieldset>

    <fieldset class="fieldset">
      <legend class="fieldset-legend">Password</legend>
      <input type="password" class="input @error('password') input-error @enderror" name="password" />
      @error('password')
        <p class="fieldset-label text-error">{{ $message }}</p>
      @enderror
    </fieldset>

    <fieldset class="fieldset">
      <legend class="fieldset-legend">Confirm password</legend>
      <input type="password" class="input" name="password_confirmation" />
    </fieldset>

    <button class="btn btn-primary mt-4 w-full">Create</button>
  </form>
</x-layout>
