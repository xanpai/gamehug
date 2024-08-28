@if(count($listings['game']) > 0)
<x-ui.home-list :listings="$listings['game']" :module="$module" layout="game" card="post" :heading="__('Latest games')" />
@endif
