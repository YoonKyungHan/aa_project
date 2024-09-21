<form action="{{ route('admin.users.update', $user->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="name">이름</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
    </div>
    <div class="form-group">
        <label for="email">이메일</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
    </div>

    <div class="form-group">
        <label for="role">역할</label>
        <select class="form-control" id="role" name="role">
            <!-- 옵션들은 JavaScript에 의해 동적으로 추가됩니다 -->
        </select>
    </div>
    <div class="text-right">
        <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
        <button type="submit" class="btn btn-primary">저장</button>
    </div>
</form>