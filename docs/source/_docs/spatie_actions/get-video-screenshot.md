---
title: Get Video Screenshot
description: Get Video Screenshot Action
extends: _layouts.documentation
section: content
lang: it
id: 43
parent_id: 10
---

# Get Video Screenshot Action {#get-video-screenshot-action}

File Name:

```php
\Modules\Media\Actions\GetVideoScreenshotAction.php
```

Input parameters:

```php
/* disk name for mp4 files (from config/filesystem.php) */
string $disk_mp4

/* path of mp4 file inside disk */
string $file_mp4

/* time when to get screenshot */
int $time

/* disk name for jpg files (from config/filesystem.php) */
string $disk_jpg

/* optional path of jpg file to export (inside jpg disk)

If this path is not specified, it will be called like this:

VideoName-ScreenshotTime.jpg
*/
?string $file_jpg = null
```

Returns:

```php
/* Returns this array if the screenshot is taken successfully */
return [
    'message' => 'ok',
    'status' => 200,
    'disk_jpg' => $disk_jpg,
    'file_jpg' => $file_jpg,
];

/* In case of error, it returns \Exception */
```
