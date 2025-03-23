<x-layout title="Edit User Page">
  <x-user-form :user="$user" :positions="$positions" :action="route('users.update', $user)" method="put" />
</x-layout>
