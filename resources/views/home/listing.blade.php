@forelse($posts as $post)
<li class="py-12">
  <article class="space-y-2 xl:grid xl:grid-cols-4 xl:space-y-0 xl:items-baseline">
    <dl>
        <dt class="sr-only">Published on</dt>
        <dd class="text-base font-medium text-gray-500"><time datetime="2021-08-11T19:30:00.000Z">{{ date('F d, Y', strtotime($post->publication_date)) }}</time></dd>
    </dl>
    <div class="space-y-5 xl:col-span-3">
        <div class="space-y-6">
            <h2 class="text-2xl font-bold tracking-tight"><a class="text-gray-900" href="javascript:void(0);">{{ $post->title }}</a></h2>
            <div class="prose max-w-none text-gray-500">
                <div class="prose max-w-none">
                <p>{{ $post->description }}</p>
                </div>
            </div>
        </div>
    </div>
    </article>
</li>
@empty
    No record found
@endforelse