<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
    </head>
    <body>
        <h1>Channels</h1>
        @foreach($channels as $channel)
            {{ $channel->youtube_title }}<br>
        @endforeach

        <h1>Playlists</h1>
        @foreach($playlists as $playlist)
            {{ $playlist->youtube_title }}<br>
        @endforeach

        <h1>Videos</h1>
        @foreach($videos as $video)
            {{ $video->youtube_title }}<br>
        @endforeach
    </body>
</html>
