<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Requests\Users\ChangePasswordRequest;
use App\Requests\Users\UserRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $view ='backend.users.';

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index(Request $request)
    {
        try {
            $filterParameters['name'] = $request->name ?? null;
            $filterParameters['email'] = $request->email ?? null;
            $with = [];
            $select=['*'];
            $users = $this->userRepo->getAllUsers($filterParameters,$select,$with);
            return view($this->view . 'index',compact('users','filterParameters'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function create()
    {
        try {
            return view($this->view.'create');
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getFile());
        }
    }

    public function store(UserRequest $request)
    {
        try{
            $validatedData = $request->validated();
            $validatedData['password'] = bcrypt($validatedData['password']);
            DB::beginTransaction();
                $this->userRepo->store($validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'New User Added Successfully');
        }catch(\Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        try {
            $userDetail = $this->userRepo->findUserDetailById($id);
            return view($this->view.'show',compact('userDetail'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getFile());
        }
    }

    public function edit($id)
    {
        try {
            $userDetail = $this->userRepo->findUserDetailById($id);
            return view($this->view.'edit',compact('userDetail'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getFile());
        }
    }

    public function update(UserRequest $request,$id)
    {
        try{
            $validatedData = $request->validated();
            $userDetail = $this->userRepo->findUserDetailById($id);
            if(!$userDetail){
                throw new \Exception('User Detail Not Found',404);
            }
            DB::beginTransaction();
             $update = $this->userRepo->update($userDetail,$validatedData);
            DB::commit();
            if($update){
                if($update->role == 'user'){
                    Auth::logout();
                }
            }
            return redirect()->back()->with('success', 'User Detail Updated Successfully');
        }catch(Exception $exception){
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
                $this->userRepo->toggleIsActiveStatus($id);
            DB::commit();
            return redirect()->back()->with('success', 'Users Is Active Status Changed  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $usersDetail = $this->userRepo->findUserDetailById($id);
            if (!$usersDetail) {
                throw new \Exception('Users Detail Not Found', 404);
            }
            DB::beginTransaction();
                $this->userRepo->delete($usersDetail);
            DB::commit();
            return redirect()->back()->with('success', 'User Detail Removed Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function changePassword(ChangePasswordRequest $request,$userId)
    {
        try{
            $validatedData = $request->validated();
            $userDetail = $this->userRepo->findUserDetailById($userId);
            if (!$userDetail) {
                throw new \Exception('Users Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->userRepo->changePassword($userDetail,$validatedData['new_password']);
            DB::commit();
            return redirect()->back()->with('success', 'User Password Changed Successfully');

        }catch(Exception $exception){
            return redirect()->back()->with('danger', $exception->getMessage());
        }

    }
}
