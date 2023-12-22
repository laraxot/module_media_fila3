---
title: Get Video Duration
description: Get Video Duration Action
extends: _layouts.documentation
section: content
lang: it
id: 40
parent_id: 10
---

# Get Video Duration Action {#get-video-duration-action}

File Name:

```php
\Modules\Media\Actions\GetVideoDurationAction.php
```

Input parameters:

```php
/* disk name (from config/filesystem.php) */
string $disk

/* path of mp4 video inside disk */
string $path
```

Returns:

```php
/* Video duration in milliseconds */
int $duration;
```