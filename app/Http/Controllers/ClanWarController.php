<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use Illuminate\Http\Request;

class ClanWarController extends Controller
{
    public function index()
    {
        // Нужно отображать тех, кто онлайн! Отправить им приглашение в лобби!
        // Владелец клана может создать клан. Выбрав участнинов и карту. Затем участиники должны подтвердить и начнется поиск
        // Если хотя бы один не подтвердил, то клан не может начать поиск + если кто-то отменит тоже самое!
        return 'In WORK';
    }

    public function ratings()
    {
        $clans = Clan::orderBy('points', 'DESC')->get();
        return view('clan.ratings', compact('clans'));
    }
}
