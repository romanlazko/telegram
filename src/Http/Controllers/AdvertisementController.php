<?php

namespace Romanlazko\Telegram\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Romanlazko\Telegram\App\Telegram;
use Romanlazko\Telegram\Exceptions\TelegramException;
use Romanlazko\Telegram\Http\Actions\SendAdvertisement;
use Romanlazko\Telegram\Http\Requests\AdvertisementRequest;
use Romanlazko\Telegram\Models\Advertisement;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Telegram $telegram)
    {
        $advertisements = Advertisement::where('bot_id', $telegram->getBotId())->get();

        return view('telegram::advertisement.index', compact(
            'advertisements'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('telegram::advertisement.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvertisementRequest $request, Telegram $telegram)
    {
        $images = [];

        $advertisement = Advertisement::create([
            'bot_id' => $telegram->getBotId(),
            ...Arr::except($request->validated(), ['images'])
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = ['url' => Storage::url($image->store('public/advertisements'))];
            }
            $advertisement->images()->createMany(
                $images
            );
        }

        return redirect()->route('advertisement.index')->with([
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
    public function show(Advertisement $advertisement, Telegram $telegram, SendAdvertisement $sendAdvertisement)
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
    public function edit(Advertisement $advertisement)
    {
        // $distributions = $advertisement->distributions()->orderByDesc('created_at')->paginate(20);

        // $distributions->each(function($distribution){
        //     $distribution->chat_ids = collect(json_decode($distribution->chat_ids));
        //     $distribution->results = collect(json_decode($distribution->results));
        //     $distribution->chats_count = $distribution->chat_ids->count();
        //     $distribution->ok_count = $distribution->results->where('ok', true)->count();
        //     $distribution->false_count = $distribution->results->where('ok', false)->count();
        // });

        return view('telegram::advertisement.edit', compact(
            'advertisement',
            // 'distributions'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdvertisementRequest $request, Advertisement $advertisement)
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
                $images[] = ['url' => Storage::url($image->store('public/advertisements'))];
            }

            $advertisement->images()->createMany(
                $images
            );
        }

        return redirect()->route('advertisement.index')->with([
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
