<form method="POST" action="{{ route('follows.store') }}">
    @csrf
    <input type="hidden" name="to" value="{{ $user->id }}">
    <x-primary-button>
        @if (auth()->user()->isFollowing($user))
            Following
        @else
            Follow
        @endif
    </x-primary-button>
</form>
