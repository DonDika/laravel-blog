
<x-front.layout>

    <!-- variable -->
    <x-slot name="pageHeader">
        {{ $lastData->title }}
    </x-slot>
    <x-slot name="pageBackground">
        {{ asset(getenv('CUSTOM_THUMBNAIL_LOCATION')."/".$lastData->thumbnail)  }}
    </x-slot>
    <x-slot name="pageHeaderLink">
        {{ route('blog-detail',['slug'=>$lastData->slug]) }}
    </x-slot>
    <x-slot name="pageSubheading">
        {{ $lastData->description }}
    </x-slot>


    <!-- Main Content -->
    <div class="container px-4 px-lg-5">
        <div>
            <h1>Sorry, this page is under maintenance!</h1>
        </div>
    </div>

</x-front.layout>




