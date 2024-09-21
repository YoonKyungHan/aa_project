@extends('adminlte::page')

@section('title', 'User Management')

@section('content_header')
<h1>User Management</h1>
@stop

@section('content')

<x-admin.modal id="editUserModal" title="사용자 편집">
@slot('body')
<div id="modalContent">
    <!-- 여기에 동적으로 내용이 로드됩니다 -->
</div>
@endslot
</x-admin.modal>

<x-admin.data-table id="users-table" thead="ID, Name, Email, Actions">
    <x-slot name="thead">
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
    </x-slot>
</x-admin.data-table>

@push('js')
<script>
    $(document).ready(function() {
        $('#users-table').DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": "{{ route('admin.users.data') }}",
                "dataSrc": function(json) {
                    console.log(json); // Log the entire response to the console
                    return json.data;
                }
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "email"
                },
                {
                    "data": "actions",
                    "orderable": false,
                    "searchable": false
                }
            ],
            "pageLength": 10,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
            "drawCallback": function(settings) {
                var api = this.api();
                var recordsTotal = api.page.info().recordsTotal;
                $('.dataTables_info').html('Total records: ' + recordsTotal);
            }
        }).buttons().container().appendTo('#users-table_wrapper .col-md-6:eq(0)');

        var modal = $('#editUserModal');

        $(document).on('click', '.edit-user', function(e) {
            e.preventDefault();
            var userId = $(this).data('user-id');
            var url = $(this).attr('href');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#modalContent').html(response.html);
                    // 역할 선택 필드를 동적으로 생성
                    var roleSelect = $('#role');
                    roleSelect.empty();
                    roleSelect.append($('<option></option>').val('').text('역할을 선택하세요'));
                    $.each(response.roles, function(index, role) {
                        var option = $('<option></option>').val(role.id).text(role.name);
                        if (response.userRoles.includes(role.id)) {
                            option.prop('selected', true);
                        }
                        roleSelect.append(option);
                    });
                    // 선택된 역할이 없으면 '선택' 옵션을 선택 상태로 만듦
                    if (!response.userRoles || response.userRoles.length === 0) {
                        roleSelect.val('');
                    }
                    modal.modal('show');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', xhr.responseText);
                    alert('사용자 데이터를 불러오는 중 오류가 발생했습니다.');
                }
            });
        });
    });
</script>
@endpush
@stop