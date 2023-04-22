<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Repositories\EventRepository;
use App\Requests\Event\EventRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    private $view = 'backend.event.';

    private EventRepository $eventRepo;


    public function __construct(EventRepository $eventRepo)
    {
        $this->eventRepo = $eventRepo;
    }

    public function index(Request $request)
    {
        try {
            $events = $this->eventRepo->getAllEventDetails();
            return view($this->view . 'index', compact('events'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function create()
    {
        try {
            return view($this->view.'create');
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function store(EventRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['hospital_id'] = AppHelper::getHospitalId();
            DB::beginTransaction();
            $this->eventRepo->store($validatedData);
            DB::commit();
            return redirect()->back()
                ->with('success', 'New Event Added Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('danger', $e->getMessage())
                ->withInput();
        }
    }

    public function show($id)
    {
        try {
            $select = ['description','title','sub_title'];
            $event = $this->eventRepo->findEventDetailById($id, $select);
            $event->description = strip_tags($event->description);
            return response()->json([
                'data' => $event,
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }


    public function edit($id)
    {
        try {
            $eventDetails = $this->eventRepo->findEventDetailById($id);
            return view($this->view.'edit',compact('eventDetails'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(EventRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $eventDetail = $this->eventRepo->findEventDetailById($id);
            if (!$eventDetail) {
                throw new \Exception('Event Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->eventRepo->update($eventDetail, $validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Event Detail Updated Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function toggleStatus($id)
    {
        try {
            DB::beginTransaction();
            $this->eventRepo->toggleStatus($id);
            DB::commit();
            return redirect()->back()->with('success', 'Status changed  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $eventDetail = $this->eventRepo->findEventDetailById($id);
            if (!$eventDetail) {
                throw new \Exception('Event Record Not Found', 404);
            }
            DB::beginTransaction();
            $this->eventRepo->delete($eventDetail);
            DB::commit();
            return redirect()->back()->with('success', 'Event Record Deleted  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

}
