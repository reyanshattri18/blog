@extends('layouts.default')
@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 xl:max-w-5xl xl:px-0">
    <main>
        <div class="divide-y divide-gray-200">
            <div class="pt-6 pb-8 space-y-2 md:space-y-5">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl md:text-[4rem] md:leading-[3.5rem]">Latest Posts</h1>
                <p class="text-lg text-gray-500">All the latest CSS news, straight from the team.</p>
            </div>
            <input type="hidden" name="max_page" value="{{$posts->lastPage()}}">
            <ul class="divide-y divide-gray-200 post-content">
                @include('home.listing')
            </ul>

            <!-- Ajax Loader -->
            <div class="ajax-loader hidden flex w-100 justify-center pt-3">
                <div style="border-top-color:transparent" class="w-16 h-16 border-4 border-blue-400 border-solid rounded-full animate-spin"></div>
            </div>
        </div>
        <!-- Ajax Loader -->
    </main>
</div>

<!-- Modal -->
<div id="modal" class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-gray-500 bg-opacity-50 transform scale-0 transition-transform duration-300 flex-col">
    <div class="bg-white w-1/2 p-6">
        <div class="sm:flex sm:items-start">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                    Posts Added
                </h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500">
                        New posts have been added
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-gray-50 w-1/2 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button onclick="closeModal()" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Ok</button>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var $modal = $('#modal')
    var $ajaxLoader = $('.ajax-loader')
    var $postContent = $('.post-content')
    var page = 1
    var maxPage = $('[name="max_page"]').val()

    var pusher = new Pusher("{{env('MIX_PUSHER_APP_KEY')}}", {
        cluster: 'ap2'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
        $modal.addClass('scale-100')
    });

    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height() && page < maxPage) {
            page += 1
            loadMoreData(page);
        }
    });

    function closeModal () {
        $modal.removeClass('scale-100')
    }

    function loadMoreData(page) {
        $.ajax({
            url: "{{route('home.index')}}",
            data: {
                page: page
            },
            beforeSend: function () {
                $ajaxLoader.removeClass('hidden')
            },
            success: function (response) {
                $ajaxLoader.addClass('hidden')
                $postContent.append(response)
            }
        })
    }
</script>
@endsection
