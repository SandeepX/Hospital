<table>
    <thead>
    <tr aria-rowspan="3">
        <th colspan="7"  style="text-align: center">
            <strong> Career Applicants Lists  </strong>
        </th>
    </tr>
    <tr>
        <th>S.N</th>
        <th style="text-align: center;"><b>Applicant Name</b></th>
        <th style="text-align: center;"><b>Career Name</b></th>
        <th style="text-align: center;"><b>Email</b></th>
        <th style="text-align: center;"><b>Contact Number</b></th>
        <th style="text-align: center;"><b>Expected Salary</b></th>
        <th style="text-align: center;"><b>Note</b></th>
        <th style="text-align: center;"><b>Uploaded CV Link</b></th>
        <th style="text-align: center;"><b>Uploaded Cover Letter Link</b></th>
    </tr>
    </thead>
    <tbody>
    @forelse($careerApplicants as $key => $value)
        <tr>
            <td>{{++$key}}</td>
            <td>{{ucfirst($value->full_name)}}</td>
            <td>{{($value->careerMasterDetail) ? ucfirst($value->careerMasterDetail->title) : 'N/A'}}</td>
            <td>{{($value->email)}} </td>
            <td>{{($value->contact_no)}}</td>
            <td>{{($value->expected_salary)}}</td>
            <td>{!! $value->note !!}</td>
            <td>{{ $value->cv ? asset(\App\Models\CareerApplicant::UPLOAD_PATH.'/'.$value->cv) : 'N/A'}}</td>
            <td>{{ $value->cover_letter ? asset(\App\Models\CareerApplicant::UPLOAD_PATH.'/'.$value->cover_letter) : 'N/A'}}</td>
        </tr>
    @empty
        <tr>
            <td colspan="100%">
                <p class="text-center"><b>No records found!</b></p>
            </td>
        </tr>
    @endforelse
    </tbody>
</table>
