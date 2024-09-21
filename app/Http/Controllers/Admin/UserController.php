<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

/**
 * @group 사용자 관리
 *
 * 사용자 관리와 관련된 API 엔드포인트
 */
class UserController extends Controller
{


    /**
     * 사용자 목록 조회
     *
     * 페이지네이션된 사용자 목록을 반환합니다.
     *
     * @return \Illuminate\View\View
     * @response status=401 scenario="토큰 없음" {
     *  "message": "로그인이 필요한 서비스입니다.",
     *  "code": "UNAUTHORIZED"
     * }
     */
    public function index()
    {
        // 권한 이름으로 권한 ID 가져오기
        // $user = User::find(1);
        // $permission = $user->permissions;
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * 사용자 데이터 조회
     *
     * DataTables에 사용될 사용자 데이터를 JSON 형식으로 반환합니다.
     *
     * @queryParam draw int 데이터 요청 횟수. Example: 1
     * @queryParam start int 시작 레코드 번호. Example: 0
     * @queryParam length int 페이지당 레코드 수. Example: 10
     *
     * @response {
     *  "draw": 1,
     *  "recordsTotal": 50,
     *  "recordsFiltered": 50,
     *  "data": [
     *    {
     *      "id": 1,
     *      "name": "John Doe",
     *      "email": "john@example.com",
     *      "actions": "<a href='/admin/users/1/edit' class='btn btn-sm btn-primary'>Edit</a>"
     *    }
     *  ]
     * }
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        $query = User::query();
        $count = $query->count();

        return DataTables::of($query->limit(10))
            ->addColumn('actions', function ($user) {
                return '<a href="' . route('admin.users.edit', $user->id) . '" class="btn btn-sm btn-primary edit-user" data-user-id="' . $user->id . '">Edit</a>';
            })
            ->rawColumns(['actions'])
            ->with(['recordsTotal' => $count, 'recordsFiltered' => $count])
            ->make(true);
    }

    /**
     * 사용자 편집 페이지
     *
     * 특정 사용자의 편집 페이지를 반환합니다.
     *
     * @urlParam id int required 사용자의 ID. Example: 1
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return response()->json([
            'html' => view('admin.users.edit', compact('user'))->render(),
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $user->roles->pluck('id')->toArray()
        ]);
    }

    /**
     * 사용자 정보 업데이트
     *
     * 특정 사용자의 정보를 업데이트합니다.
     *
     * @urlParam id int required 사용자의 ID. Example: 1
     * @bodyParam name string required 사용자의 이름. Example: John Doe
     * @bodyParam email string required 사용자의 이메일. Example: john@example.com
     * @bodyParam password string 사용자의 새 비밀번호 (선택적).
     *
     * @response {
     *  "message": "User updated successfully."
     * }
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id 사용자 ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|exists:roles,id',
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();
        //역활 업데이트
        $role = Role::findOrFail($request->input('role'));
        $user->roles()->sync([$role->id]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * 로그인 페이지
     *
     * 로그인 페이지를 반환합니다.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // if ($request->isMethod('post')) {
        //     $credentials = $request->only('name', 'password');
        //     if (Auth::attempt($credentials)) {
        //         return redirect()->route('admin.dashboard');
        //     }
        //     return back()->withErrors(['name' => 'These Credentials do not match our records.  ']);
        // }

        // return view('admin.login');
    }

    /**
     * 로그인 페이지로 리다이렉트
     *
     * 로그인 페이지로 리다이렉트합니다.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login');
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
