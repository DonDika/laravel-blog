
<x-front.layout>

    <!-- parsing variable data -->
    <div>
        <x-slot name="pageHeader">
            {{ $detailData->title }}
        </x-slot>
        <x-slot name="pageBackground">
            {{ asset(getenv('CUSTOM_THUMBNAIL_LOCATION')."/".$detailData->thumbnail)  }}
        </x-slot>
        <x-slot name="pageHeaderLink">
            {{ route('blog-detail',['slug'=>$detailData->slug]) }}
        </x-slot>
        <x-slot name="pageSubheading">
            {{ $detailData->description }}
        </x-slot>
        <x-slot name="pageTitle">
            {{ $detailData->title }}
        </x-slot>
    
    </div>

    <!-- Main Content-->
    <article class="mb-4">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
    
                    <!-- parsing data content -->
                    {!! $detailData->content !!}
                   
                </div>
            </div>
        </div>
    </article>

</x-front.layout>




