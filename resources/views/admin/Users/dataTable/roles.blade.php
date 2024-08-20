<div>
    @foreach ($roles as $role)
        @if($role == 'user')
        <span class="badge badge-primary">{{ $role }}</span>
        @endif

        @if($role == 'admin')
        <span class="badge badge-danger">{{ $role }}</span>
        @endif

        @if($role == 'SuperAdmin')
        <span class="badge badge-success">{{ $role }}</span>
        @endif
    @endforeach
</div>
