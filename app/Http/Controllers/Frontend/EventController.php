<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\EventRepository;
use App\Repositories\StaticPageDetailRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class EventController extends Controller
{
    private $view = 'frontend.events.';

    private StaticPageDetailRepository $pagesRepo;
    private EventRepository $eventRepo;

    public function __construct(StaticPageDetailRepository $pagesRepo, EventRepository $eventRepo)
    {
        $this->pagesRepo = $pagesRepo;
        $this->eventRepo = $eventRepo;
    }

    public function index(): Factory|View|Application|RedirectResponse
    {
        try {
            $with = ['page'];
            $slug = 'events';
            $select= ['id','title','sub_title','event_start_on','event_ends_on','venue','image'];
            $events = $this->eventRepo->getAllEventDetails($select);
            $pageDetail = $this->pagesRepo->findAboutUsDetailBySlug($slug,$with);
            return view($this->view . 'event-list', compact('events', 'pageDetail'));
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function getEventDetailById($eventId): Factory|View|Application|RedirectResponse
    {
        try{
            $selectEvent = ['id','title','image'];
            $events =  $this->eventRepo->getLatestSixEvents($selectEvent);
            $eventDetail =  $this->eventRepo->findEventDetailById($eventId);
            $url = route('front.event-details',$eventId);
            $socialShare =  \Share::page( $url,$eventDetail->title)
                            ->facebook()
                            ->twitter()
                            ->reddit()
                            ->linkedin()
                            ->telegram();
            return view($this->view .'event-detail',compact('events','eventDetail','socialShare'));
        }catch(\Exception $exception){
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }
}
