<x-layout title="Users Page">
  <div class="navbar bg-base-100 shadow-sm mb-2">
    <a href="{{ route('users.create') }}" class="btn btn-soft btn-primary">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
      </svg>

      <span>Create New User</span>
    </a>
  </div>

  @if ($users->count())
    <div class="overflow-x-auto">
      <table class="table">
        <!-- head -->
        <thead>
          <tr>
            {{-- <th>
              <label>
                <input type="checkbox" class="checkbox" />
              </label>
            </th> --}}
            <th>Name</th>
            <th>Position</th>
            <th>Email</th>
            <th>Phone</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody id="show-more-list">
          <x-user-items :users="$users" />
        </tbody>
        <!-- foot -->
        <tfoot>
          <tr>
            {{-- <th></th> --}}
            <th>Name</th>
            <th>Position</th>
            <th>Email</th>
            <th>Phone</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>

    <x-show-more-button :route="route('users.index')" :currentPage="$users->currentPage()" :lastPage="$users->lastPage()" :nextPage="$users->nextPageUrl()" />
  @else
    <div role="alert" class="alert alert-error alert-soft">
      <span>No records found.</span>
    </div>
  @endif

</x-layout>
