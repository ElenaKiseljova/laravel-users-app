<x-layout title="Users Page">
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
