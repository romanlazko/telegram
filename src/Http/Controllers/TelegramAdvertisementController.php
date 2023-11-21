<?php

namespace Romanlazko\Telegram\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Romanlazko\Telegram\App\Bot;
use Romanlazko\Telegram\Exceptions\TelegramException;
use Romanlazko\Telegram\Http\Actions\SendAdvertisement;
use Romanlazko\Telegram\Http\Requests\AdvertisementRequest;
use Romanlazko\Telegram\Models\TelegramBot;
use Romanlazko\Telegram\Models\Advertisement;

class TelegramAdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TelegramBot $telegram_bot)
    {
        $bot = new Bot($telegram_bot->token);

        $telegram_bot->photo = $bot::getPhoto(['file_id' => $telegram_bot->photo]);

        $advertisements = $telegram_bot->advertisements;

        return view('admin.telegram.advertisement.index', compact(
            'telegram_bot',
            'advertisements'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(TelegramBot $telegram_bot)
    {
        return view('admin.telegram.advertisement.create', compact(
            'telegram_bot'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertisementRequest $request, TelegramBot $telegram_bot)
    {
        $images = [];

        $advertisement = $telegram_bot->advertisements()->create(
            Arr::except($request->validated(), ['images'])
        );

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = ['url' => Storage::url($image->store("public/{$telegram_bot->username}/advertisements"))];
            }
            $advertisement->images()->createMany(
                $images
            );
        }

        return redirect()->route('admin.telegram_bot.advertisement.index', $telegram_bot)->with([
            'ok' => true,
            'description' => "Advertisement succesfuly created"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Advertisement $advertisement, SendAdvertisement $sendAdvertisement)
    {
        $admins = $telegram->getAdmins();

        $response = null;

        foreach ($admins as $admin) {
            try {
                if ($admin) {
                    $response[$admin] = $sendAdvertisement($telegram, $advertisement, $admin);
                }
            }
            catch (TelegramException $e) {
                $response[$admin] = $e->getMessage();
            }
        }
        dd($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TelegramBot $telegram_bot, Advertisement $advertisement)
    {
        // $distributions = $advertisement->distributions()->orderByDesc('created_at')->paginate(20);

        // $distributions->each(function($distribution){
        //     $distribution->chat_ids = collect(json_decode($distribution->chat_ids));
        //     $distribution->results = collect(json_decode($distribution->results));
        //     $distribution->chats_count = $distribution->chat_ids->count();
        //     $distribution->ok_count = $distribution->results->where('ok', true)->count();
        //     $distribution->false_count = $distribution->results->where('ok', false)->count();
        // });

        return view('admin.telegram.advertisement.edit', compact(
            'advertisement',
            'telegram_bot'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertisementRequest $request, TelegramBot $telegram_bot, Advertisement $advertisement)
    {
        $images = [];

        $advertisement->update(
            Arr::except($request->validated(), ['images'])
        );

        if ($request->has('delete_images')){
            foreach ($request->delete_images as $id) {
                $image = $advertisement->images()->find($id);
                $filePath = str_replace('/storage', 'public', $image->url);
                if (Storage::delete($filePath)){
                    $image->delete();
                }
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = ['url' => Storage::url($image->store("public/{$telegram_bot->username}/advertisements"))];
            }

            $advertisement->images()->createMany(
                $images
            );
        }

        return redirect()->route('admin.telegram_bot.advertisement.index', $telegram_bot)->with([
            'ok' => true,
            'description' => "Advertisement succesfuly updated"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advertisement $advertisement)
    {
        $images = $advertisement->images;

        foreach ($images as $image) {
            $filePath = str_replace('/storage', 'public', $image->url);
            if (Storage::delete($filePath)){
                $image->delete();
            }
        }

        $advertisement->delete();

        return redirect()->route('advertisement.index')->with([
            'ok' => true,
            'description' => "Advertisement succesfuly deleted"
        ]);
    }
}
