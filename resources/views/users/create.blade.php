<x-layout title="Create User Page">
  <x-user-form :user="$user" :positions="$positions" :action="route('users.store')" method="post" />
</x-layout>
