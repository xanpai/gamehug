<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Blade::directive('parseTabs', function ($expression) {
            return "<?php echo \App\Providers\AppServiceProvider::parseTabs($expression); ?>";
        });
    }

    public static function parseTabs($content)
    {
        $pattern = '/\[tabs\](.*?)\[\/tabs\]/s';
        return preg_replace_callback($pattern, function ($matches) {
            $tabsContent = $matches[1];
            $tabPattern = '/\[tab title="(.*?)"\](.*?)\[\/tab\]/s';
            preg_match_all($tabPattern, $tabsContent, $tabMatches, PREG_SET_ORDER);

            $tabTitles = array_map(function ($match) {
                return $match[1];
            }, $tabMatches);
            $tabsHtml = '<div x-data="{ activeTab: \'' . $tabTitles[0] . '\' }" class="mb-4">';
            $tabsHtml .= '<div class="flex border-gray-700 bg-gray-800 rounded">';

            foreach ($tabMatches as $index => $tab) {
                $title = $tab[1];
                $tabsHtml .= "
                    <button 
                        @click=\"activeTab = '$title'\" 
                        :class=\"{ 'bg-primary-500 text-white rounded': activeTab === '$title', 'text-gray-400 hover:text-white rounded hover:bg-primary-500/10': activeTab !== '$title' }\"
                        class=\"px-4 py-2 font-semibold focus:outline-none transition duration-150 ease-in-out rounded-t-lg\"
                    >
                        $title
                    </button>";
            }

            $tabsHtml .= '</div>';

            foreach ($tabMatches as $index => $tab) {
                $title = $tab[1];
                $content = $tab[2];
                $tabsHtml .= "
                    <div x-show=\"activeTab === '$title'\" class=\"p-4 bg-gray-800 text-white rounded-b-lg\">
                        $content
                    </div>";
            }

            $tabsHtml .= '</div>';

            return $tabsHtml;
        }, $content);
    }
}
