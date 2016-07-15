![Shoutzor-logo](./shoutzor-logo.png)

The Shoutzor Module - Requires the Shoutzor Theme to function as intended.

Shoutzor is a system designed to have music playing at events like a LAN-Party.
Comes with an AutoDJ when no music is requested to ensure music keeps playing.

Shoutzor (optionally) uses [AcoustID](https://acoustid.org/) for music fingerprinting to prevent double uploads and to get correct music information.<br />

make sure to install the `x264*`, `swh-plugins`, `festival`, `curl` and `gstreamer1.0*` packages;<br />
when finished, install `liquidsoap` and `liquidsoap-plugin-all`

Also make sure to have the apache `rewrite` module enabled and allow htaccess to rewrite URL's.
As well as having the `php5-curl` module installed.

###Features
- Liquidsoap for audio stream generation
- AutoDJ to continue playing tracks when no requests are in queue
- AcoustID Implementation For Music Fingerprinting
- LastFM Implementation for Artist / Album information

###TODO
- Implement Youtube video search & request functionality
- Check if Media is still on STATUS_PROCESSING after > 15 minutes after uploading (this would safely indicate something has gone wrong)

###changelog
#####Since 1.1:
- Bugfix: forgot `use` statement in QueueManager
- Bugfix: Leftover `createIndex()` method in Scripts preventing installation

#####Since 1.0:
- Improved the AutoDJ, it now selects a random track by the same rules as normal users do when requesting (delays per-media object & per-artist).
- Implemented artist-based request delay (any media files from the same artist now have a configurable delay)
- Renamed the title on the admin Shoutzor Controls page (to what it should've been all along)
- Implemented JS API methods required for the Admin Page
- All controls on the admin page now work
- Added Processing message to the progressbar when 100% is reached so people wont think it just froze
- Added warning message to the upload page when users try to navigate away while uploads are still active
