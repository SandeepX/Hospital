<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Repositories\TestimonialRepository;
use App\Requests\testimonial\TestimonialRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class TestimonialController extends Controller
{
    private $view = 'backend.testimonial.';

    private TestimonialRepository $testimonialRepo;


    public function __construct(TestimonialRepository $testimonialRepo)
    {
        $this->testimonialRepo = $testimonialRepo;
    }

    public function index(Request $request)
    {
        try {
            $with = [];
            $filterParameters['name'] = $request->name ?? null;
            $filterParameters['is_published'] = $request->is_published ?? null;
            $select=['*'];
            $testimonials = $this->testimonialRepo->getAllTestimonialDetails($filterParameters,$select,$with);
            return view($this->view . 'index', compact('testimonials','filterParameters'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function create()
    {
        try {
            return view($this->view . 'create');
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function store(TestimonialRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $validatedData['hospital_id'] = AppHelper::getHospitalId();
            DB::beginTransaction();
            $this->testimonialRepo->store($validatedData);
            DB::commit();
            return redirect()->back()
                ->with('success', 'New Testimonial Added Successfully');
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
            $select = ['description', 'name'];
            $testimonialDetail = $this->testimonialRepo->findTestimonialDetailById($id, $select);
            $testimonialDetail->description = strip_tags($testimonialDetail->description);
            return response()->json([
                'data' => $testimonialDetail,
            ]);
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }


    public function edit($id)
    {
        try {
            $testimonialDetails = $this->testimonialRepo->findTestimonialDetailById($id);
            return view($this->view . 'edit', compact('testimonialDetails'));
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function update(TestimonialRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();
            $testimonialDetail = $this->testimonialRepo->findTestimonialDetailById($id);
            if (!$testimonialDetail) {
                throw new \Exception('Testimonial Detail Not Found', 404);
            }
            DB::beginTransaction();
            $this->testimonialRepo->update($testimonialDetail, $validatedData);
            DB::commit();
            return redirect()->back()->with('success', 'Testimonial Detail Updated Successfully');
        } catch (\Exception $exception) {
            return redirect()->back()
                ->with('danger', $exception->getMessage())->withInput();
        }
    }

    public function toggleIsPublishedStatus($id)
    {
        try {
            DB::beginTransaction();
             $this->testimonialRepo->toggleStatus($id);
            DB::commit();
            return redirect()->back()->with('success', 'Publish Status changed  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $testimonialDetail = $this->testimonialRepo->findTestimonialDetailById($id);
            if (!$testimonialDetail) {
                throw new \Exception('Event Record Not Found', 404);
            }
            DB::beginTransaction();
                $this->testimonialRepo->delete($testimonialDetail);
            DB::commit();
            return redirect()->back()->with('success', 'Testimonial Detail Deleted  Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

}


