<?php

namespace App\Http\Controllers;

use Auth;
use App\Channel;
use App\Playlist;
use App\Video;
use App\Http\Requests;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SyncController extends Controller
{
    public function all()
    {
        $user = Auth::user();
        $token = $user->youtube_token;

        $client = new Client([
            "base_uri" => "https://www.googleapis.com/youtube/v3/",
        ]);

        $response = $client->get("channels", [
            "headers" => [
                "Authorization" => "Bearer {$token}"
            ],
            "query" => [
                "mine" => "true",
                "part" => "contentDetails,snippet",
            ],
        ]);

        $channels = $response->getBody();
        $channels = json_decode($channels);

        if (isset($channels->items)) {
            foreach ($channels->items as $channel) {
                $channel_id = $channel->id;

                $record = Channel::firstOrNew([
                    "youtube_id" => $channel->id,
                ]);

                $record->youtube_title = $channel->snippet->title;
                $record->save();

                $response = $client->get("playlists", [
                    "headers" => [
                        "Authorization" => "Bearer {$token}"
                    ],
                    "query" => [
                        "part" => "contentDetails,snippet",
                        "channelId" => $channel_id,
                    ],
                ]);

                $playlists = $response->getBody();
                $playlists = json_decode($playlists);

                if (isset($playlists->items)) {
                    foreach ($playlists->items as $playlist) {
                        $playlist_id = $playlist->id;

                        $record = Playlist::firstOrNew([
                            "youtube_id" => $playlist->id,
                        ]);

                        $record->youtube_title = $playlist->snippet->title;
                        $record->save();

                        $pageToken = null;

                        do {
                            $response = $client->get("playlistItems", [
                                "headers" => [
                                    "Authorization" => "Bearer {$token}"
                                ],
                                "query" => [
                                    "part" => "contentDetails,snippet",
                                    "playlistId" => $playlist_id,
                                    "pageToken" => $pageToken
                                ],
                            ]);

                            $videos = $response->getBody();
                            $videos = json_decode($videos);

                            $pageToken = null;

                            if (!empty($videos->nextPageToken)) {
                                print ".";
                                ob_flush();
                                flush();

                                $pageToken = $videos->nextPageToken;
                            }

                            if (isset($videos->items)) {
                                foreach ($videos->items as $video) {
                                    $record = Video::firstOrNew([
                                        "youtube_id" => $video->id,
                                        "youtube_published_at" => date("Y-m-d H:i:s", strtotime($video->snippet->publishedAt)),
                                    ]);

                                    $record->youtube_title = $video->snippet->title;
                                    $record->save();
                                }
                            }
                        } while ($pageToken !== null);
                    }
                }
            }
        }

        return "done";
    }
}
