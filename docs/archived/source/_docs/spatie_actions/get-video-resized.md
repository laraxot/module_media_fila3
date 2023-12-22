---
title: Get Video Resized
description: Get Video Resized Action
extends: _layouts.documentation
section: content
lang: it
id: 42
parent_id: 10
---

# Get Video Resized Action {#get-video-resized-action}

File Name:

```php
\Modules\Media\Actions\GetVideoResizedAction.php
```

Input parameters:

```php
/* source sdisk name for mp4 files (from config/filesystem.php) */
string $from_disk

/* path of the video file inside source disk */
string $from_file

/* new video width to resize video */
int $width

/* new video height to resize video */
int $height

/* destination disk name (from config/filesystem.php) */
string $to_disk

/* destination file path name inside destination disk */
string $to_file
```

Returns:

```php
/* Returns this array if the screenshot is taken successfully */
return [
    'message' => 'ok',
    'status' => 200,
    'to_disk' => $to_disk,
    'to_file' => $to_file,
];
```
