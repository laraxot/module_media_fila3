---
title: Download Video
description: Download Video Action
extends: _layouts.documentation
section: content
lang: it
id: 20
parent_id: 8
---

# Download Video Action {#download-video-action}

Action Path:

```php
/Modules/Media/Models/Panels/Actions/DownloadVideoAction.php
```

Panel Path:

```php
/Modules/Media/Models/Panels/VideoPanel.php
```

Policy Path:

```php
/Modules/Media/Models/Panels/Policies/VideoPanelPolicy.php
```

Action Type:

```php
On Item
```

Handler functionality:

1. Gets Video model "\Modules\Media\Models\Video"
2. Dispatches a Queued Job: 

```php
/Modules/Media/Jobs/DownloadVideo.php
```

3. This queued job downloads the video from $row->url, or throws a Throwable $exception