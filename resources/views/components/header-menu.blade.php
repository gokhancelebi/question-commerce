<nav class="hidden md:flex items-center space-x-8">
    <a href="{{ route('home') }}" class="text-gray-800 hover:text-primary transition-colors whitespace-nowrap">Ana Sayfa</a>
    @foreach($pages as $page)
    <a href="{{ route('pages.show', $page->slug) }}" class="text-gray-800 hover:text-primary transition-colors whitespace-nowrap">{{ $page->title }}</a>
    @endforeach
</nav> 