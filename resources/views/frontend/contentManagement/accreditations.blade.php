@extends('frontend.layouts.master')

@section('title','Accreditations')

@section('main-content')

    <section class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-outer text-center">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Accreditations</li>
                    </ul>
                </nav>
                <h2>Accreditations</h2>
            </div>
        </div>
    </section>

    <!-- Gallery Starts -->
    <section class="gallery">
        <div class="container">
            <div class="row">
                @forelse($accreditations as $key => $detail)
                    <div class="col-lg-12 col-md-6 mb-4">
                        <div class="gallery-main">
                            <div class="gallery-item">
                                <a href="{{asset(\App\Models\StaticPageDetail::UPLOAD_PATH.'Thumb-'.$detail->image)}}"><img src="{{asset(\App\Models\StaticPageDetail::UPLOAD_PATH.'Thumb-'.$detail->image)}}" alt="Image" title="{{$detail->title}}"></a>
                                <div class="gallery-content">
                                    <div class="gallery-inner">
                                        <h3>
                                            <a href="{{asset(\App\Models\StaticPageDetail::UPLOAD_PATH.'Thumb-'.$detail->image)}}">
                                                {{ucfirst($detail->title)}}
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse

                <!-- Pagination -->
                <div class="col-lg-12">
                    <div class="{{$accreditations->hasPages() ? 'pagination__wrapper':''}} text-center">
                        <ul class="pagination">
                            {{$accreditations->appends($_GET)->links()}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Gallery Ends -->



@endsection
