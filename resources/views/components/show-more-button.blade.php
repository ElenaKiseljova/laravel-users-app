@props(['route', 'currentPage', 'lastPage', 'nextPage'])

@if ($currentPage < $lastPage)
  <div class="navbar bg-base-100 shadow-sm mb-2">
    <a href="{{ $nextPage }}" data-route="{{ $route }}" data-current-page="{{ $currentPage }}"
      data-last-page="{{ $lastPage }}" class="show-more-button btn btn-soft btn-secondary ml-auto">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
      </svg>

      <span>Show more</span>
    </a>
  </div>
@endif
