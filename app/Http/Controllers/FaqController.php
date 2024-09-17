<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = [
            ['question' => 'What is EpicRepacks?', 'answer' => 'EpicRepacks is a platform that offers free repack games, which are compressed to reduce size for easier downloading. We also provides uncompressed pre-installed (portable) games for those who prefer to skip the installation process, everything here is free.'],
            ['question' => 'Should i choose repack or portable?', 'answer' => 'We offer both Repacks and Pre-installed games, it depends on your preference. Repacks are smaller in size but takes time to installer, while pre-installed are larger in size but you just need to extract the archive and play.'],
            ['question' => 'How does EpicRepacks source its games?', 'answer' => 'EpicRepacks sources games from forums like CS.RIN and all our repacks are based on original ISO files released by scene groups.'],
            ['question' => 'Do I need an account to download games from EpicRepacks?', 'answer' => 'No, you do not need an account to access or download games from EpicRepacks.'],
            ['question' => 'Why should i create an account at EpicRepacks?', 'answer' => 'Creating an account lets you save your browse history in EpicRepacks, it shows your liked content and also you can create watchlist and manage your profile.'],
            ['question' => 'How often are new games or updates added to EpicRepacks?', 'answer' => 'New games and updates are added daily on EpicRepacks.'],
            ['question' => 'How can I get help with installation or download issues?', 'answer' => 'You can get help and support by joining our Discord server, where our community can assist you.'],
            ['question' => 'Is EpicRepacks safe to use?', 'answer' => 'Yes, EpicRepacks ensures that all games are thoroughly checked for safety before uploading. The files are clean and free from malware.'],
            ['question' => 'How do I download a game from EpicRepacks?', 'answer' => 'To download a game, simply click the Download button on the game page. This will redirect you to a download page where you can start the download process.'],
            ['question' => 'How can I update a game from EpicRepacks?', 'answer' => '1. Download the latest version of the game from the site. 2. Rename the old version’s folder to prevent overwriting. Extract the new version into the game directory. 3. Verify that the game works and retains your saved data. 4. Delete the old version if the new one functions correctly.'],
            ['question' => 'How do I request a game on EpicRepacks?', 'answer' => 'Go to the Request Games page on EpicRepacks and submit a request using the specified format to ask for a game update.'],
            ['question' => 'How can I change the language', 'answer' => 'For Steam games: 1. Check the in-game settings for language. 2. If not available, look for .ini files in the game directory and edit the relevant lines. For GOG games: Use .info files instead of .ini files. If these options are unavailable, the language files may not be included.'],
            ['question' => 'My anti-virus flagged a game as a trojan. What should I do?', 'answer' => 'Anti-virus programs may incorrectly flag game files as a trojan due to their cracked nature. This is usually a false positive. Temporarily disable your anti-virus, re-extract the game files, and it should run without issues. All games on EpicRepacks are tested for safety.'],
            ['question' => 'Where are save files located for games?', 'answer' => 'Save file locations vary by game but are typically found in ‘Documents’ or ‘AppData’. You can also search online for “Grand Theft Auto V save file location” for specific instructions.'],
            ['question' => 'I’m encountering error while trying to download. How can I fix this?', 'answer' => 'Please report this on our Discord server or use the contact page, and our moderators will help you out asap.'],
            ['question' => 'Can I play multiplayer with cracked games from EpicRepacks?', 'answer' => 'Some cracked games support multiplayer, You can check the Multiplayer channel in our Discord to find out more.'],
            ['question' => 'How do I add multiplayer online fixes to games?', 'answer' => 'Download the “Online-Fix” files from the game page and copy them into the game’s base directory. For more detailed instructions, you can either google or ask our mods on reddit and discord'],
            ['question' => 'How can I increase my download speeds?', 'answer' => 'To boost download speeds, use Internet Download Manager (IDM) or Free Download Manager.']
            // Add more FAQs as needed
        ];

        return view('faq.index', compact('faqs'));
    }
}
