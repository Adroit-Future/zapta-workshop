<?php

use App\Models\User;
use App\Broadcasting\PremiumChannel;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('user.{toUserId}', function ($user, $toUserId) {
    return $user->id == $toUserId;
});

Broadcast::channel('mychannel', function ($user) {
    return true;
});

Broadcast::channel('premium.{id}',PremiumChannel::class);


Broadcast::channel('chat.{roomId}', function (User $user, int $roomId) {
    // if ($user->canJoinRoom($roomId)) {
        return ['id' => $user->id, 'name' => $user->name];
    // }
});
