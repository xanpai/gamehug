<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = [
            ['question' => 'What is AnkerGames?', 'answer' => 'AnkerGames is a free PC game download website offering compressed and pre-installed games (portable) for faster and easier access. Every game here is completely free to download, with no extra steps needed for installation.'],
            ['question' => 'What are portable games on AnkerGames?', 'answer' => 'Portable games are pre-installed games. We’ve handled all the updates, patches, and fixes, so you only need to extract the files and start playing—no installation required.'],
            ['question' => 'How does AnkerGames source its games?', 'answer' => 'AnkerGames sources its games from trusted forums like CS.RIN. All games are based on original ISO files released by scene groups, ensuring high quality and reliability.'],
            ['question' => 'Do I need an account to download games from AnkerGames?', 'answer' => 'No account is required to download free games from AnkerGames. Simply visit the game page and start downloading instantly.'],
            ['question' => 'Why should I create an account at AnkerGames?', 'answer' => 'While you can download games without an account, creating one allows you to save your browsing history, create a personalized watchlist, like content, and manage your profile for a better user experience.'],
            ['question' => 'How often are new games or updates added to AnkerGames?', 'answer' => 'New games and updates are added daily, so check back frequently for the latest titles and improvements.'],
            ['question' => 'How can I get help with installation or download issues?', 'answer' => 'If you encounter any issues, join our Discord server for community support, where you can get assistance from both staff and fellow users.'],
            ['question' => 'Is AnkerGames safe to use?', 'answer' => 'Yes, all games on AnkerGames are thoroughly tested and verified for safety. The files are free from malware. We recommend scanning files yourself for added peace of mind.'],
            ['question' => 'How do I download a game from AnkerGames?', 'answer' => 'Simply click the "Download" button on the game page. You will be redirected to a download page where the process will begin.'],
            ['question' => 'How do I update a game from AnkerGames?', 'answer' => 'To update a game: 1) Download the latest version from the website. 2) Rename the old version’s folder. 3) Extract the new version. 4) Test to ensure the update works, then delete the old version if successful.'],
            ['question' => 'How do I request a game on AnkerGames?', 'answer' => 'Submit a game request by visiting our “Request Games” page. Follow the specified format, and remember to request cracked games only. Repetitive requests will be ignored.'],
            ['question' => 'How can I change the game language?', 'answer' => 'For Steam games, check the in-game settings or modify .ini files in the game directory. For GOG games, use .info files. If these options aren’t available, the game may not include additional language files.'],
            ['question' => 'My antivirus flagged a game as a trojan. What should I do?', 'answer' => 'Cracked game files may trigger false positives in antivirus software. Temporarily disable your antivirus and re-extract the game. All AnkerGames files are checked for malware before being uploaded.'],
            ['question' => 'Where are game save files located?', 'answer' => 'Game save files are usually located in the "Documents" or "AppData" folders. You can search online for specific game save locations (e.g., “GTA V save file location”).'],
            ['question' => 'I encountered an error while downloading. How can I fix it?', 'answer' => 'Report the error on our Discord server or via the contact page. Our moderators will help resolve the issue as soon as possible.'],
            ['question' => 'Can I play multiplayer with cracked games from AnkerGames?', 'answer' => 'Some cracked games support multiplayer. Visit our Discord’s Multiplayer channel for more information about which games are supported.'],
            ['question' => 'How do I add multiplayer online fixes to games?', 'answer' => 'Download the “Online-Fix” files from the game’s page and copy them into the game’s base directory. For additional help, ask our Discord mods or check online guides.'],
            ['question' => 'How can I increase my download speeds?', 'answer' => 'To boost download speeds, use Internet Download Manager (IDM) or Free Download Manager for a more efficient and faster download process.']
        ];

        $config = [
            'title' => config('settings.faqs_title'),
            'description' => config('settings.faqs_description'),
        ];

        return view('faq.index', compact('faqs', 'config'));
    }
}
