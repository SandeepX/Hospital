<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\TeamRepository;
use App\Requests\Users\TeamRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    private $view = 'backend.team.';

    private TeamRepository $teamRepo;

    public function __construct(TeamRepository $teamRepo
    )
    {
        $this->teamRepo = $teamRepo;
    }

    public function index()
    {
        try {
            $teams = $this->teamRepo->getAllTeamDetails();
            return view($this->view . 'index', compact('teams'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function create()
    {
        try {
            return view($this->view . 'create');
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function store(TeamRequest $request)
    {
        try {
            $validatedData = $request->validated();
            DB::beginTransaction();
            $this->teamRepo->store($validatedData);
            DB::commit();
            return redirect()->back()
                ->with('success', 'New Team Added Successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('danger', $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $teamDetails = $this->teamRepo->findTeamDetailById($id);
            return view($this->view . 'edit', compact('teamDetails'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(TeamRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $teamDetail = $this->teamRepo->findTeamDetailById($id);
            if (!$teamDetail) {
                throw new Exception('Team Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->teamRepo->update($teamDetail, $validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Team Detail Updated Successfully');
        } catch (Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
            $this->teamRepo->toggleStatus($id);
            DB::commit();
            return redirect()->back()->with('success', 'Status changed  Successfully');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $teamDetail = $this->teamRepo->findTeamDetailById($id);
            if (!$teamDetail) {
                throw new Exception('Team Record Not Found', 404);
            }
            DB::beginTransaction();
            $this->teamRepo->delete($teamDetail);
            DB::commit();
            return redirect()->back()->with('success', 'Team Record Deleted  Successfully');
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function getTeamMemberPosition()
    {
        try {
            $select = ['id' , 'name' , 'position'];
            $teamMembers = $this->teamRepo->getTeamMemberListByPosition($select);
            return view($this->view . 'memberPosition', compact('teamMembers'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function teamMemberPositionUpdate(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'teamMemberId' => 'required|array|min:1',
                'teamMemberId.*' => 'required|numeric'
            ]);
            DB::beginTransaction();
                $this->teamRepo->updateTeamMemberPosition($validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Team Member Order Position Updated Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }


}
