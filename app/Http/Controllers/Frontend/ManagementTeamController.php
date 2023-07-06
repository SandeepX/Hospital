<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\PagesRepository;
use App\Repositories\TeamRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class ManagementTeamController extends Controller
{
    private TeamRepository $teamRepo;
    private PagesRepository $pagesRepo;

    public function __construct(TeamRepository $teamRepo,PagesRepository $pagesRepo)
    {
        $this->teamRepo = $teamRepo;
        $this->pagesRepo = $pagesRepo;
    }

    public function index()
    {
        try {
            $teams = $this->teamRepo->getAllActiveTeams();
            $pageDetail = $this->pagesRepo->findPageDetailBYPageSlug('management-team');
            return view( 'frontend.team',compact('teams','pageDetail'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }
}
