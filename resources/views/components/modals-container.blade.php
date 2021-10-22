@can('update', $idea)
    {{-- @push('modals') da ne ucitava, ovo bismo koristili --}}
        <livewire:edit-idea :idea="$idea" /> 
    {{-- @endpush --}}
@endcan

@can('delete', $idea)
    <livewire:delete-idea :idea="$idea" />
@endcan

@auth
    <livewire:mark-idea-as-spam :idea="$idea" />
@endauth

@admin
    <livewire:mark-idea-as-not-spam :idea="$idea" />
@endadmin

@auth
    <livewire:edit-comment />
@endauth

@auth
    <livewire:delete-comment />
@endauth