<?php

namespace App\Repositories;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardRepository
{
    public function getChirayuHospitalDashboardDetail()
    {
        $totalDoctor = DB::table('doctors')
            ->select('hospital_id',DB::raw('COUNT(id) as total_doctors'))
            ->where('is_active',1)
            ->groupBy('hospital_id');

        $totalDepartment = DB::table('departments')
            ->select('hospital_id',DB::raw('COUNT(id) as total_department'))
            ->where('is_active',1)
            ->groupBy('hospital_id');

        $totalPendingTodayAppointment = DB::table('appointments')
            ->select('hospital_id',DB::raw('COUNT(id) as total_pending_appointments'))
            ->whereDate('appointment_date', Carbon::now()->format('Y-m-d'))
            ->where('status','pending')
            ->groupBy('hospital_id');

        $totalAcceptedTodayAppointment = DB::table('appointments')
            ->select('hospital_id',DB::raw('COUNT(id) as total_accepted_appointments'))
            ->whereDate('appointment_date', Carbon::now()->format('Y-m-d'))
            ->where('status','accepted')
            ->groupBy('hospital_id');

        return DB::table('hospital_profiles')
            ->select(
            'hospital_profiles.name as hospital_name',
            'doctors.total_doctors',
            'departments.total_department',
            'pending_appointment.total_pending_appointments',
            'accepted_appointment.total_accepted_appointments'
        )
            ->leftJoinSub($totalDoctor,'doctors',function($join){
                $join->on('doctors.hospital_id','=','hospital_profiles.id');
            })

            ->leftJoinSub($totalDepartment,'departments',function($join){
                $join->on('hospital_profiles.id','=','departments.hospital_id');
            })

            ->leftJoinSub($totalPendingTodayAppointment,'pending_appointment',function($join){
                $join->on('hospital_profiles.id','=','pending_appointment.hospital_id');
            })

            ->leftJoinSub($totalAcceptedTodayAppointment,'accepted_appointment',function($join){
                $join->on('hospital_profiles.id','=','accepted_appointment.hospital_id');
            })
        ->first();

    }
}
