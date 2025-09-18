@extends('layout.main')

@push('script')
    <script>
        $(document).on('click', '.btn-edit', function () {
            const id = $(this).data('id');
            $('#editModal form').attr('action', '{{ route('user.index') }}/' + id);
            $('#editModal input:hidden#id').val(id);
            $('#editModal input#name').val($(this).data('name'));
            $('#editModal input#phone').val($(this).data('phone'));
            $('#editModal input#email').val($(this).data('email'));

            // Set role dropdown value
            $('#editModal select#edit_role').val($(this).data('role'));

            // Clear password field
            $('#editModal input#edit_password').val('');

            if ($(this).data('active') == 1) {
                $('#editModal input#is_active').attr('checked', 1)
            } else {
                $('#editModal input#is_active').removeAttribute('checked');
            }
        });
    </script>
@endpush

@section('content')
    <x-breadcrumb
        :values="[__('menu.users')]">
        <button
            type="button"
            class="btn btn-primary btn-create"
            data-bs-toggle="modal"
            data-bs-target="#createModal">
            {{ __('menu.general.create') }}
        </button>
    </x-breadcrumb>

    <div class="card mb-5">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>{{ __('model.user.name') }}</th>
                    <th>{{ __('model.user.email') }}</th>
                    <th>{{ __('model.user.phone') }}</th>
                    <th>Role</th>
                    <th>{{ __('model.user.is_active') }}</th>
                    <th>{{ __('menu.general.action') }}</th>
                </tr>
                </thead>
                @if($data)
                    <tbody>
                    @foreach($data as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td><span class="badge bg-label-{{ $user->role == 'admin' ? 'danger' : 'info' }} me-1">{{ ucfirst($user->role) }}</span></td>
                            <td><span
                                    class="badge bg-label-primary me-1">{{  __('model.user.' . ($user->is_active ? 'active' : 'nonactive')) }}</span>
                            </td>
                            <td>
                                <button class="btn btn-info btn-sm btn-edit"
                                        data-id="{{ $user->id }}"
                                        data-name="{{ $user->name }}"
                                        data-email="{{ $user->email }}"
                                        data-phone="{{ $user->phone }}"
                                        data-active="{{ $user->is_active }}"
                                        data-role="{{ $user->role }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal">
                                    {{ __('menu.general.edit') }}
                                </button>
                                <form action="{{ route('user.destroy', $user) }}" class="d-inline" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm btn-delete"
                                            type="button">{{ __('menu.general.delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                @else
                    <tbody>
                    <tr>
                        <td colspan="6" class="text-center">
                            {{ __('menu.general.empty') }}
                        </td>
                    </tr>
                    </tbody>
                @endif
                <tfoot class="table-border-bottom-0">
                <tr>
                    <th>{{ __('model.user.name') }}</th>
                    <th>{{ __('model.user.email') }}</th>
                    <th>{{ __('model.user.phone') }}</th>
                    <th>Role</th>
                    <th>{{ __('model.user.is_active') }}</th>
                    <th>{{ __('menu.general.action') }}</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {!! $data->appends(['search' => $search])->links() !!}

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="{{ route('user.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalTitle">{{ __('menu.general.create') }}</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <x-input-form name="name" :label="__('model.user.name')"/>
                    <x-input-form name="email" :label="__('model.user.email')" type="email"/>
                    <x-input-form name="phone" :label="__('model.user.phone')"/>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="staff">Staff</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        {{ __('menu.general.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary">{{ __('menu.general.save') }}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form class="modal-content" method="post" action="">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalTitle">{{ __('menu.general.edit') }}</h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <x-input-form name="name" :label="__('model.user.name')"/>
                    <x-input-form name="email" :label="__('model.user.email')" type="email"/>
                    <x-input-form name="phone" :label="__('model.user.phone')"/>

                    <div class="mb-3">
                        <label for="edit_role" class="form-label">Role</label>
                        <select class="form-select" id="edit_role" name="role">
                            <option value="staff">Staff</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_password" class="form-label">New Password (Leave blank to keep current)</label>
                        <input type="password" id="edit_password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                        <div class="form-text">Only fill this field if you want to change the user's password.</div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active" value="true" id="is_active">
                        <label class="form-check-label" for="is_active"> {{ __('model.user.is_active') }} </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        {{ __('menu.general.cancel') }}
                    </button>
                    <button type="submit" class="btn btn-primary">{{ __('menu.general.update') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
