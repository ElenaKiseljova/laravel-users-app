<x-layout title="Main Page">
  <div class="flex flex-row space-x-3">
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Users</a>
    <a href="{{ route('positions.index') }}" class="btn btn-primary">Positions</a>
  </div>
</x-layout>
