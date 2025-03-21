<x-layout title="Positions Page">
  @if ($positions->count())
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
            <th>Users count</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <x-position-items :positions="$positions" />
        </tbody>
        <!-- foot -->
        <tfoot>
          <tr>
            {{-- <th></th> --}}
            <th>Name</th>
            <th>Users count</th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  @else
    <div role="alert" class="alert alert-error alert-soft">
      <span>No records found.</span>
    </div>
  @endif

</x-layout>
