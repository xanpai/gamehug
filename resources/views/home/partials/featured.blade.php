@if (count($listings['featured']) > 0)
    <x-ui.home-list :listings="$listings['featured']" :module="$module" layout="game" card="post" :heading="__('Trending Games')" />
@endif
