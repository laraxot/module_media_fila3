---
title: Get Video Frame Content
description: Get Video Frame Content Action
extends: _layouts.documentation
section: content
lang: it
id: 41
parent_id: 10
---

# Get Video Frame Content Action {#get-video-frame-content-action}

Ritorna una stringa che contiene i contenuti di un frame del file video $file_mp4 situato sul disco $disk_mp4. 

Il frame viene ottenuto cercando la posizione temporale specificata $time nel file video e estraendo il frame in quella posizione. 

Il frame viene quindi esportato e i suoi contenuti vengono restituiti come stringa.

File Name:

```php
\Modules\Media\Actions\GetVideoFrameContentAction.php
```

Input parameters:

```php
//mp4 disk name
string $disk_mp4
//mp4 path inside disk
string $file_mp4
//seconds when to take screenshot
int $time
```
