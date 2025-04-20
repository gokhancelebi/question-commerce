<ul class="space-y-3">
    @if($type === 'main')
    <li><a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors">Ana Sayfa</a></li>
    @endif
    
    @foreach($pages as $page)
    <li><a href="{{ route('pages.show', $page->slug) }}" class="text-gray-400 hover:text-white transition-colors">{{ $page->title }}</a></li>
    @endforeach
    
    @if($type === 'support')
    <li><a href="{{ route('faqs.index') }}" class="text-gray-400 hover:text-white transition-colors">SSS</a></li>
    @endif
</ul>