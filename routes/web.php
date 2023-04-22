<?php

use App\Http\Controllers\Backend\AppointmentController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CareerApplicantController;
use App\Http\Controllers\Backend\CareerDesignationController;
use App\Http\Controllers\Backend\CareerMasterDetailController;
use App\Http\Controllers\Backend\ContactUsController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\DoctorController;
use App\Http\Controllers\Backend\DoctorPageSettingController;
use App\Http\Controllers\Backend\DoctorPositionController;
use App\Http\Controllers\Backend\DoctorScheduleController;
use App\Http\Controllers\Backend\DownloadController;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\ExtraServicesController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\HospitalProfileController;
use App\Http\Controllers\Backend\HospitalServiceController;
use App\Http\Controllers\Backend\MediaLinkController;
use App\Http\Controllers\Backend\PackageController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\StaticPageDetailController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\CareerController;
use App\Http\Controllers\Frontend\ContentManagementController;
use App\Http\Controllers\Frontend\OurInternationalPatientController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\WelcomePageController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/**
 * Backend Section Routes
 *
 */

Auth::routes([
    'register' => false,
]);

Route::get('/home', [HomeController::class, 'index'])->name('home');

/** Admin And Accountant Authorized Backend Routes */

Route::group([
    'middleware' => ['auth', 'permission'],
    'prefix' =>'chirayu'
], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin');

    /** Appointment route */
    Route::resource('appointments', AppointmentController::class, [
        'only' => ['index', 'create', 'edit', 'update', 'store', 'show']
    ]);
    Route::get('appointments/delete/{doctorId}', [AppointmentController::class, 'delete'])->name('appointments.delete');
    Route::put('appointments/update-status/{id}', [AppointmentController::class, 'updateAppointmentRequestStatus'])->name('appointments.update-status');
});


/** Only Admin Authorized Backend Routes */

Route::group([
        'middleware' => ['auth', 'admin'],
        'prefix' =>'admin'
    ], function () {

    /** User route */
    Route::resource('users', UserController::class, [
        'only' => ['index', 'create', 'edit', 'update', 'store']
    ]);
    Route::get('users/{id}/show-detail', [UserController::class, 'show'])->name('users.show');
    Route::get('users/toggle-status/{id}', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::get('users//delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    Route::post('users/change-password/{userId}', [UserController::class, 'changePassword'])->name('users.change-password');

    /** Hospital Profile route */
    Route::resource('hospital-profiles', HospitalProfileController::class, [
        'only' => ['index', 'store', 'update']
    ]);

    /** Department route */
    Route::resource('departments', DepartmentController::class);
    Route::get('departments/toggle-status/{id}', [DepartmentController::class, 'toggleStatus'])->name('departments.toggle-status');
    Route::get('departments/delete/{id}', [DepartmentController::class, 'delete'])->name('departments.delete');
    Route::get('departments-position', [DepartmentController::class, 'departmentPosition'])->name('departmentsPosition');
    Route::post('departments-position-update', [DepartmentController::class, 'departmentPositionUpdate'])->name('departments.departmentPositionUpdate');



    /** Team Member route */

    Route::get('team/adjust-order', [TeamController::class, 'getTeamMemberPosition'])->name('team.adjustPosition');
    Route::post('team/position-update', [TeamController::class, 'teamMemberPositionUpdate'])->name('team.updatePosition');
    Route::resource('team', TeamController::class);
    Route::get('team/toggle-status/{id}', [TeamController::class, 'toggleStatus'])->name('team.toggle-status');
    Route::get('team/delete/{id}', [TeamController::class, 'delete'])->name('team.delete');


    /** Hospital Service route */
    Route::resource('hospital-services', HospitalServiceController::class);
    Route::get('hospital-services/toggle-status/{id}', [HospitalServiceController::class, 'toggleStatus'])->name('hospital-services.toggle-status');
    Route::get('hospital-services/toggle-quick-service-status/{id}', [HospitalServiceController::class, 'toggleQuickServicesStatus'])->name('hospital-services.toggle-quick-service-status');
    Route::get('hospital-services/delete/{id}', [HospitalServiceController::class, 'delete'])->name('hospital-services.delete');

    /** Hospital Extra Service route */
    Route::resource('hospital-extra-services', ExtraServicesController::class);
    Route::get('hospital-extra-services/toggle-status/{id}', [ExtraServicesController::class, 'toggleStatus'])->name('hospital-extra-services.toggle-status');
    Route::get('hospital-extra-services/delete/{id}', [ExtraServicesController::class, 'delete'])->name('hospital-extra-services.delete');


    /** Hospital Package route */
    Route::resource('hospital-packages', PackageController::class);
    Route::get('hospital-packages/toggle-status/{id}', [PackageController::class, 'toggleStatus'])->name('hospital-packages.toggle-status');
    Route::get('hospital-packages/delete/{id}', [PackageController::class, 'delete'])->name('hospital-packages.delete');

    /** Events route */
    Route::resource('events', EventController::class);
    Route::get('events/toggle-status/{id}', [EventController::class, 'toggleStatus'])->name('events.toggle-status');
    Route::get('events/delete/{id}', [EventController::class, 'delete'])->name('events.delete');

    /** Testimonial route */
    Route::resource('testimonials', TestimonialController::class);
    Route::get('testimonials/toggle-status/{id}', [TestimonialController::class, 'toggleIsPublishedStatus'])->name('testimonials.toggle-status');
    Route::get('testimonials/delete/{id}', [TestimonialController::class, 'delete'])->name('testimonials.delete');


    /** Content Management route */

    Route::get('pages', [PageController::class, 'getAllPages'])->name('pages.index');
    Route::get('pages/{id}/edit', [PageController::class, 'editPage'])->name('pages.edit');
    Route::put('pages/update/{id}', [PageController::class, 'updatePageDetail'])->name('pages.update');

    Route::resource('staticPageDetails', StaticPageDetailController::class);
    Route::get('staticPageDetails/toggle-status/{id}', [StaticPageDetailController::class, 'toggleStatus'])->name('staticPageDetails.toggle-status');
    Route::get('staticPageDetails/delete/{id}', [StaticPageDetailController::class, 'delete'])->name('staticPageDetails.delete');

    Route::resource('media-links', MediaLinkController::class);
    Route::get('media-links/toggle-status/{id}', [MediaLinkController::class, 'toggleStatus'])->name('media-links.toggle-status');
    Route::get('media-links/delete/{id}', [MediaLinkController::class, 'delete'])->name('media-links.delete');

    Route::resource('banners', BannerController::class);
    Route::get('banners/toggle-status/{id}', [BannerController::class, 'toggleStatus'])->name('banners.toggle-status');
    Route::get('banners/delete/{id}', [BannerController::class, 'delete'])->name('banners.delete');

    Route::resource('blogs', BlogController::class);
    Route::get('blogs/toggle-status/{id}', [BlogController::class, 'toggleStatus'])->name('blogs.toggle-status');
    Route::get('blogs/delete/{id}', [BlogController::class, 'delete'])->name('blogs.delete');

    /** Career Management route */

    Route::resource('career-designations', CareerDesignationController::class);
    Route::get('career-designations/toggle-status/{id}', [CareerDesignationController::class, 'toggleStatus'])->name('career-designations.toggle-status');
    Route::get('career-designations/delete/{id}', [CareerDesignationController::class, 'delete'])->name('career-designations.delete');

    Route::resource('career-opportunities', CareerMasterDetailController::class);
    Route::get('career-opportunities/toggle-status/{id}', [CareerMasterDetailController::class, 'toggleStatus'])->name('career-opportunities.toggle-status');
    Route::get('career-opportunities/delete/{id}', [CareerMasterDetailController::class, 'delete'])->name('career-opportunities.delete');

    Route::resource('career-applicants', CareerApplicantController::class, [
        'only' => ['index', 'show']
    ]);
    Route::get('career-applicants/delete/{id}', [CareerApplicantController::class, 'delete'])->name('career-applicants.delete');

    /** Contact Us route */
    Route::get('contact-us/{enquiryId}/enquiry-detail', [ContactUsController::class, 'show'])->name('contact-us.show');
    Route::get('contact-us', [ContactUsController::class, 'index'])->name('contact-us.index');
    Route::get('contact-us/delete/{id}', [ContactUsController::class, 'delete'])->name('contact-us.delete');

    /** Gallery route */
    Route::resource('galleries', GalleryController::class);
    Route::get('galleries/toggle-status/{id}', [GalleryController::class, 'toggleStatus'])->name('galleries.toggle-status');
    Route::get('galleries/delete/{id}', [GalleryController::class, 'delete'])->name('galleries.delete');



    /** Doctor route */
    Route::get('doctors/{id}/details', [DoctorController::class, 'getDoctorAllDetail'])->name('doctors.getAllDoctorDetail');
    Route::get('doctors/{id}/general-detail', [DoctorController::class, 'getDoctorGeneralDetailById'])->name('doctors.getDoctorGeneralDetail');
    Route::put('doctors/{id}/appointment-update', [DoctorController::class, 'updateAppointmentLimitOfDoctor'])->name('doctors.update-appointment-limit');
    Route::resource('doctors', DoctorController::class, [
        'only' => ['index', 'create', 'edit', 'update', 'store']
    ]);
    Route::get('doctors/toggle-status/{id}', [DoctorController::class, 'toggleStatus'])->name('doctors.toggle-status');
    Route::get('doctors/delete/{id}', [DoctorController::class, 'delete'])->name('doctors.delete');

    /** Doctor Position route */
    Route::resource('doctors-position', DoctorPositionController::class,[ 'only' => ['index']  ]);
    Route::post('doctors-position/update', [DoctorPositionController::class, 'doctorsPositionUpdate'])->name('doctors-position.updatePosition');

    /** Doctor schedule route */

    Route::get('doctor-schedules/{doctorId}/show-detail', [DoctorScheduleController::class, 'show'])->name('doctor-schedules.show');
    Route::get('doctor-schedules/{doctorId}/schedule-create', [DoctorScheduleController::class, 'createSchedule'])->name('doctor-schedules.getScheduleForm');
    Route::resource('doctor-schedules', DoctorScheduleController::class, [
        'only' => ['index', 'create', 'edit', 'update', 'store']
    ]);
    Route::get('doctor-schedules/doctors/{dept_id}', [DoctorScheduleController::class, 'getAllDoctorByDepartmentId'])->name('doctor-schedules.get-department-doctors');
    Route::get('doctor-schedules/toggle-status/{id}', [DoctorScheduleController::class, 'toggleStatus'])->name('doctor-schedules.toggle-status');
    Route::get('doctor-schedules/delete/{doctorId}', [DoctorScheduleController::class, 'delete'])->name('doctor-schedules.delete');


    /** Download Route */
    Route::resource('downloads', DownloadController::class, [
        'only' => ['index', 'create', 'store']
    ]);
    Route::get('downloads/file/delete/{id}', [DownloadController::class, 'delete'])->name('downloads.delete');
    Route::get('downloads/file/toggle-status/{id}', [DownloadController::class, 'toggleStatus'])->name('downloads.toggle-status');


    /** settings route */
    Route::resource('doctor-page-settings', DoctorPageSettingController::class, [
        'only' => ['index', 'store', 'update']
    ]);

    /** International Patients route */
    Route::resource('international-patients', \App\Http\Controllers\Backend\OurInternationalPatientController::class);
    Route::get('international-patients/toggle-status/{id}', [\App\Http\Controllers\Backend\OurInternationalPatientController::class, 'toggleStatus'])->name('international-patients.toggle-status');
    Route::get('international-patients/delete/{id}', [\App\Http\Controllers\Backend\OurInternationalPatientController::class, 'delete'])->name('international-patients.delete');

});


/**
 * Frontend Section Routes
 */
Route::get('/', [WelcomePageController::class, 'getAllWelcomePageData'])->name('welcome');

Route::group([
    'prefix'=>'chirayu',
    'as'=>'front.',
],function(){

    /** welcome page content */
    Route::get('/image-360', [WelcomePageController::class, 'getImage360']);
    Route::get('/video', [WelcomePageController::class, 'video']);
    Route::get('/ad-banner', [WelcomePageController::class, 'getAdBanner']);

    /** department routes */
    Route::get('departments', [\App\Http\Controllers\Frontend\DepartmentController::class, 'index'])->name('department');
    Route::get('departments/detail/{departmentId}', [\App\Http\Controllers\Frontend\DepartmentController::class, 'getDepartmentDetailById'])->name('department-detail');

    /** services routes */
    Route::get('services', [ServiceController::class, 'index'])->name('service');
    Route::get('services-detail/{serviceId}', [ServiceController::class, 'getServiceDetailById'])->name('service-detail');

    /** contact us routes */
    Route::get('contact-us', [\App\Http\Controllers\Frontend\ContactUsController::class, 'getContactUsPage'])->name('contact-us');
    Route::post('contact-us/store', [\App\Http\Controllers\Frontend\ContactUsController::class, 'store'])->name('contact-us.store')->withoutMiddleware('clearViewCache');

    /** Gallery routes */
    Route::get('gallery', [\App\Http\Controllers\Frontend\GalleryController::class, 'index'])->name('gallery');

    /** Download routes */
    Route::get('downloads', [\App\Http\Controllers\Frontend\DownloadController::class, 'index'])->name('downloads');
    Route::get('downloads/file/{fileId}', [\App\Http\Controllers\Frontend\DownloadController::class, 'downloadFile'])->name('downloads.file-download');

    /** career us routes */
    Route::POST('applicant/store', [CareerController::class, 'applicantDetailStore'])->name('applicantDetail.store');
    Route::get('careers', [CareerController::class, 'getAllCareerList'])->name('careers');
    Route::get('career-detail/{careerId}', [CareerController::class, 'getCareerDetailById'])->name('careers.show');

    /** content management routes */
    Route::get('about-us', [ContentManagementController::class, 'getAboutUsPageDetail'])->name('about-us');
    Route::get('mission-and-vision', [ContentManagementController::class, 'getMissionVisionPageDetail'])->name('mission-vision');
    Route::get('managing-director-message', [ContentManagementController::class, 'getManagingDirectorPageDetail'])->name('md-message');
    Route::get('accreditations', [ContentManagementController::class, 'getAccreditationsPageDetail'])->name('accreditations');
    Route::get('award-recognitions', [ContentManagementController::class, 'getAwardRecognitionsPageDetail'])->name('award-recognitions');

    /** Our International Patients routes */
    Route::get('our-international-patients', [OurInternationalPatientController::class, 'getInternationalPatients'])->name('internationalPatients');
    Route::get('our-international-patients/{patientsId}', [OurInternationalPatientController::class, 'getPatientsDetail'])->name('patients-detail');

    /** doctor routes */
    Route::get('doctors', [\App\Http\Controllers\Frontend\DoctorController::class, 'index'])->name('doctors');
    Route::get('doctors/show-detail/{doctorId}', [\App\Http\Controllers\Frontend\DoctorController::class, 'getDoctorDetailByDoctorId'])->name('doctor.show');
    Route::get('doctors/list', [\App\Http\Controllers\Frontend\DoctorController::class, 'getAllActiveDoctor']);

    /** package routes */
    Route::get('packages', [\App\Http\Controllers\Frontend\PackageController::class, 'index'])->name('package');
    Route::get('{packageId}/package-detail', [\App\Http\Controllers\Frontend\PackageController::class, 'getPackageDetailById'])->name('package-detail');

    /** Management Team routes */
    Route::get('management-team', [\App\Http\Controllers\Frontend\ManagementTeamController::class, 'index'])->name('management-team');

    /** blogs routes */
    Route::get('blogs', [\App\Http\Controllers\Frontend\BlogController::class, 'index'])->name('blogs');
    Route::get('blog-detail/{blogId}', [\App\Http\Controllers\Frontend\BlogController::class, 'getBlogDetailById'])->name('blog-details');

    /** blogs routes */
    Route::get('events', [\App\Http\Controllers\Frontend\EventController::class, 'index'])->name('events');
    Route::get('event-detail/{eventId}', [\App\Http\Controllers\Frontend\EventController::class, 'getEventDetailById'])->name('event-details');

    /** appointment route */
    Route::get('appointment-departments', [\App\Http\Controllers\Frontend\AppointmentController::class, 'getAllActiveDepartments'])->name('appointment-departments');
    Route::get('appointment-doctors/{deptId}', [\App\Http\Controllers\Frontend\AppointmentController::class, 'getAllActiveDoctorByDeptId'])->name('appointment-doctors');
    Route::get('doctor/appointment-date/{doctorId}', [\App\Http\Controllers\Frontend\AppointmentController::class, 'getDoctorAvailableDate'])->name('appointment-dates');
    Route::get('doctor/appointment-time/{doctorId}', [\App\Http\Controllers\Frontend\AppointmentController::class, 'getDoctorTimeByDoctorId'])->name('appointment-time');

    Route::post('doctor/appointment/store', [\App\Http\Controllers\Frontend\AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('appointment', [\App\Http\Controllers\Frontend\AppointmentController::class, 'appointmentCreate'])->name('appointment.appointmentCreate');


});


