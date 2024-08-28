<?php

namespace App\Livewire;

use Livewire\Component;

class WatchComponent extends Component
{
    public $cover;
    public $listing;
    public $videos = [];
    public $isPreloader = true;

    public function mount($listing)
    {
        $theme_color = empty(config('settings.color')) ? '8871FD' : str_replace('#','',config('settings.color'));
        if ($listing->type == 'movie') {
            $this->cover = $listing->coverurl;
        } elseif (isset($listing->post->type) AND $listing->post->type == 'tv') {
            $this->cover = $listing->post->coverurl;
        } else {
            $this->cover = $listing->coverurl;
        }
        foreach ($listing->videos as $video) {
            $this->videos[] = [
                'label' => $video->label ?? 'Stream',
                'type' => $video->type,
                'link' => route('embed',$video->id),
            ];
        }
        if ($listing->type == 'movie') {
            if (config('settings.vidsrc') and $listing->tmdb_id) {
                $this->videos[] = [
                    'label' => 'Vidsrc',
                    'type' => 'embed',
                    'link' => 'https://vidsrc.me/embed/' . $listing->tmdb_id.'/color-'.$theme_color,
                ];
            }
        } elseif (isset($listing->post->type) AND $listing->post->type == 'tv') {
            if (config('settings.vidsrc') and $listing->post->tmdb_id) {
                $this->videos[] = [
                    'label' => 'Vidsrc',
                    'type' => 'embed',
                    'link' => 'https://vidsrc.me/embed/' . $listing->post->tmdb_id . '/' . $listing->season_number . '-' . $listing->episode_number.'/color-'.$theme_color,
                ];
            }
        }
    }

    public function watching()
    {
        $this->isPreloader = false;
    }

    public function render()
    {
        return view('livewire.watch');
    }

}
