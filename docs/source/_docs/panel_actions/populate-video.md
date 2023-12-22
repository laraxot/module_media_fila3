---
title: Populate Video
description: Populate Video Action
extends: _layouts.documentation
section: content
lang: it
id: 21
parent_id: 8
---

# Populate Video Action {#populate-video-action}


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

1. It connects to TMDB driver.

The TMDB driver in Laravel is an add-on component for the Laravel web framework that provides functionality for using the The Movie Database (TMDB) API within a Laravel project.

2. Gets the popular movies from TMDB
3. For each movie, gets the detailed informations, its poster, etc..
4. If it's a youtube video, it creates the model with its url in /Modules/Media/Models/Video.php