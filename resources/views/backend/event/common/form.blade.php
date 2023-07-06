
    <div class="row">
        <div class="col-lg-6">

            <div class="mb-3">
                <label for="title" class="form-label">Event Title </label>
                <input type="text" class="form-control" id="title" name="title"  value="{{ (isset($eventDetails) ? $eventDetails->title: old('title') )}}" autocomplete="off" required placeholder="">
            </div>

            <div class="mb-3">
                <label for="sub_title" class="form-label">Sub Title </label>
                <input type="text" class="form-control" id="sub_title" name="sub_title"  value="{{ (isset($eventDetails) ? $eventDetails->sub_title: old('sub_title') )}}" autocomplete="off"  placeholder="">
            </div>

            <div class="mb-3">
                <label for="event_start_on" class="form-label"> Event Start On </label>
                <input type="datetime-local" class="form-control" id="event_start_on" name="event_start_on" value="{{ (isset($eventDetails) ? $eventDetails->event_start_on: old('event_start_on') )}}" autocomplete="off" placeholder="">
            </div>


            <div class="mb-3">
                <label for="event_ends_on" class="form-label"> Event Ends On </label>
                <input type="datetime-local" class="form-control" id="event_ends_on" name="event_ends_on" value="{{ (isset($eventDetails) ? $eventDetails->event_ends_on: old('event_ends_on') )}}" autocomplete="off" placeholder="">

            </div>

            <div class="mb-3">
                <label for="venue" class="form-label"> Event Venue </label>
                <input type="text" class="form-control" id="venue" name="venue"  value="{{ (isset($eventDetails) ? $eventDetails->venue: old('venue') )}}" autocomplete="off" placeholder="">
            </div>


            <div class="mb-3">
                <label for="exampleFormControlSelect1" class="form-label">Status</label>
                <select class="form-select" id="is_active" name="is_active">
                    <option value="" {{ isset($eventDetails) ? '':'selected'}} disabled>Select status</option>
                    <option value="1" {{ isset($eventDetails) && ($eventDetails->is_active ) == 1 ? 'selected': old('is_active') }}>Active</option>
                    <option value="0" {{ isset($eventDetails) && ($eventDetails->is_active ) == 0 ? 'selected': old('is_active') }}>Inactive</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="upload" class="form-label">Upload Image</label>
                <input class="form-control" type="file" id="image" name="image" >
                @if(isset($eventDetails) && $eventDetails->image)
                    <img  src="{{asset(\App\Models\Event::UPLOAD_PATH.$eventDetails->image)}}"
                          alt=""  class="wd-200  ht-100 mt-3" style="object-fit: contain">
                @endif
            </div>


        </div>

        <div class="col-lg-6 mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" id="tinymceExample" rows="6">{{ ( isset($eventDetails) ? $eventDetails->description: old('description') )}}</textarea>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="link-icon" data-feather="plus"></i> {{isset($eventDetails) ? 'Update':'Create'}} </button>
        </div>
    </div>










