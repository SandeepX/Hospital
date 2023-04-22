

<div class="row">
    <div class="col-lg-6 mb-3">
        <label for="link_type" class="form-label">Media Link Type</label>
        <select class="form-select" id="link_type" name="link_type"  required>
            <option value="" {{isset($mediaLinkDetail) ? '' : 'selected'}}  disabled>Select Media Link Type</option>
            @foreach(\App\Models\MediaLink::LINK_TYPE as $value)
                <option value="{{$value}}" {{ isset($mediaLinkDetail) && ($mediaLinkDetail->link_type ) == $value ? 'selected': '' }}>
                    {{ucfirst($value)}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-6 mb-3">
        <label for="url" class="form-label"> Media link</label>
        <input type="url" class="form-control" id="url" name="url" value="{{ isset($mediaLinkDetail) &&  $mediaLinkDetail->url ? $mediaLinkDetail->url : old('url') }}" autocomplete="off" required placeholder="">
    </div>

    <div class="col-lg-6 mb-3">
        <label for="exampleFormControlSelect1" class="form-label">Status</label>
        <select class="form-select" id="is_active" name="is_active">
            <option value="" {{ isset($mediaLinkDetail) ? '':'selected'}} disabled>Select status</option>
            <option value="1" {{ isset($mediaLinkDetail) && ($mediaLinkDetail->is_active ) == 1 ? 'selected': old('is_active') }}>Active</option>
            <option value="0" {{ isset($mediaLinkDetail) && ($mediaLinkDetail->is_active ) == 0 ? 'selected': old('is_active') }}>Inactive</option>
        </select>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i> {{isset($mediaLinkDetail)? 'Update':'Save'}} </button>
    </div>
</div>
