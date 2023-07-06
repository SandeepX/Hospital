@extends('frontend.layouts.master')

@section('title','Gallery')

@section('main-content')

    <section class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-outer text-center">
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Gallery</li>
                    </ul>
                </nav>
                <h2>Gallery</h2>
            </div>
        </div>
    </section>

    <!-- Gallery Starts -->
    <section class="gallery">
        <div class="container">
            <div class="row">
                @forelse($galleryImage as $key => $imageDetail)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="gallery-main">
                            <div class="gallery-item">
                                <a href="{{asset(\App\Models\Gallery::UPLOAD_PATH.'/'.$imageDetail->image)}}">
                                    <img src="{{asset(\App\Models\Gallery::UPLOAD_PATH.'/'.$imageDetail->image)}}" alt="Image" title="{{$imageDetail->title}}">
                                </a>
                                <div class="gallery-content">
                                    <div class="gallery-inner">
                                        <h3>
                                            <a href="{{asset(\App\Models\Gallery::UPLOAD_PATH.'/'.$imageDetail->image)}}">
                                                {{ucfirst($imageDetail->title)}}
                                            </a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse


                <div class="col-lg-12 mt-4">
                    <script src="https://360player.io/static/dist/scripts/embed.js" async></script>
                    <iframe width="100%" height="500" class="rounded-bottom rounded-top rounded-0 box-shadow overflow-hidden"
                            style="border: none; max-width: 100%;" frameborder="0" allowfullscreen allow="" scrolling="no"
                            src="{{$image->url ?? 'https://kuula.co/share/collection/7vXY5?logo=1&info=1&fs=1&vr=0&sd=1&thumbs=1'}}"></iframe>
                </div>

                <!-- Pagination -->
                <div class="col-lg-12">
                    <div class="pagination__wrapper text-center">
                        <ul class="pagination">
                            {{$galleryImage->appends($_GET)->links()}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Gallery Ends -->



@endsection
