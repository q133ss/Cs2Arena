<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use Illuminate\Http\Request;

class ClanWarController extends Controller
{
    public function index()
    {
        // Если юзер не авторизован, то показываем заглушку!
        // Если он не главный в клане, то он не может начать!

        // Нужно отображать тех, кто онлайн! Отправить им приглашение в лобби!
        // Владелец клана может создать клан. Выбрав участнинов и карту. Затем участиники должны подтвердить и начнется поиск
        // Если хотя бы один не подтвердил, то клан не может начать поиск + если кто-то отменит тоже самое!

        $flag = '';
        if(auth()->check()) {
            $clan = auth()->user()->clan()?->first();
            if(auth()->id() == $clan->owner_id){
                $flag = 'owner';
            }else {
                $flag = 'member';
            }
        }else{
            $flag = 'nologin';
        }

        return view('clanwar.index', [
            'clan' => $clan ?? null,
            'flag' => $flag
        ]);
    }
}
