<x-layout :title="$user->name">
  <div class="flex flex-col gap-y-3 ">
    <div class="flex flex-row gap-x-12 w-full">
      <img src="{{ $user->photo }}" alt="{{ $user->name }}" class=" w-80 max-w-full p-1 shadow-sm" />

      <div class="flex flex-col gap-y-6">
        <div class=" space-y-2">
          <h4 class=" text-2xl font-medium text-gray-400">Position</h4>

          @if ($user->position->name)
            <div class="badge badge-xl badge-soft badge-secondary">{{ $user->position->name }}</div>
          @else
            -
          @endif
        </div>

        <div class=" space-y-2">
          <h4 class=" text-2xl font-medium text-gray-400">Email</h4>

          <p class=""><a href="mailto:{{ $user->email }}" class="link">{{ $user->email }}</a></p>
        </div>

        <div class=" space-y-2">
          <h4 class=" text-2xl font-medium text-gray-400">Phone</h4>

          <p class=""><a href="tel:{{ $user->phone }}" class="link">{{ $user->phone }}</a></p>
        </div>

        <a href="{{ route('users.edit', ['user' => $user]) }}" class="btn btn-warning btn-md">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
          </svg>

          <span>Edit</span>
        </a>
      </div>

    </div>


  </div>
</x-layout>
