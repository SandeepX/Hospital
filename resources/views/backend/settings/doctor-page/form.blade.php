

<div class="row">

    <div class="col-lg-6 mb-3">
        <label for="intro" class="form-label"> Intro Title</label>
        <input type="text" class="form-control" id="intro" name="intro" value="{{ ( $doctorPageSettingDetail ? $doctorPageSettingDetail->intro: old('intro') )}}" autocomplete="off" required placeholder="">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="time" class="form-label"> Doctor Time Title</label>
        <input type="text" class="form-control" id="time" name="time" value="{{ ( $doctorPageSettingDetail ? $doctorPageSettingDetail->time: old('time') )}}" autocomplete="off" required placeholder="">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="fix_appt" class="form-label"> Fix Appointment Title</label>
        <input type="text" class="form-control" id="fix_appt" name="fix_appt" value="{{ ( $doctorPageSettingDetail ? $doctorPageSettingDetail->fix_appt: old('fix_appt') )}}" autocomplete="off" required placeholder="">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="qualification" class="form-label"> Qualification Title</label>
        <input type="text" class="form-control" id="qualification" name="qualification" value="{{ ( $doctorPageSettingDetail ? $doctorPageSettingDetail->qualification: old('qualification') )}}" autocomplete="off" required placeholder="">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="skill" class="form-label"> Skill Title</label>
        <input type="text" class="form-control" id="skill" name="skill" value="{{ ( $doctorPageSettingDetail ? $doctorPageSettingDetail->skill: old('skill') )}}" autocomplete="off" required placeholder="">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="experience" class="form-label"> Experience Title</label>
        <input type="text" class="form-control" id="experience" name="experience" value="{{ ( $doctorPageSettingDetail ? $doctorPageSettingDetail->experience: old('experience') )}}" autocomplete="off" required placeholder="">
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i> {{$doctorPageSettingDetail? 'Update':'Save'}} </button>
    </div>
</div>
