<?php

declare(strict_types=1);

namespace Modules\Media\Http\Controllers\VideoEditor;

/**
 * ContentControllerClass.
 *
 * @author Andchir <andycoderw@gmail.com>
 */
class ContentControllerClass extends BaseControllerClass {
    /**
     * ContentControllerClass constructor.
     *
     * @param array $config
     * @param array $lang
     */
    public function __construct($config = [], $lang = []) {
        parent::__construct($config, $lang);
    }

    /**
     * Import media.
     *
     * @return array
     */
    public function importMedia() {
        @ini_set('memory_limit', '-1');
        $output = [];

        $inputUrl = ! empty($_POST['input_url']) ? trim($_POST['input_url']) : '';
        $inputFile = ! empty($_FILES['input_file']) ? $_FILES['input_file'] : [];
        $inputTitle = ! empty($_POST['input_title']) ? trim($_POST['input_title']) : '';

        $user = $this->getUser(true);
        if (false === $user) {
            return [
                'success' => false,
                'msg' => 'Forbidden.',
            ];
        }

        $userDirPath = $this->getPublicPath('input_dir', $user['id']);
        $freeSpace = $user['files_size_max'] - $user['files_size_total'];

        if (! is_dir(dirname($userDirPath))) {
            mkdir(dirname($userDirPath));
        }
        if (! is_dir($userDirPath)) {
            mkdir($userDirPath);
        }

        // Upload file
        if (! empty($inputFile)) {
            $error = '';
            for ($i = 0; $i < count($inputFile['name']); ++$i) {
                if (UPLOAD_ERR_OK != $inputFile['error'][$i]) {
                    continue;
                }
                $fileName = time().'_'.uniqid();
                $tmp_name = $inputFile['tmp_name'][$i];
                $name = $inputFile['name'][$i];
                $ext = $this->getExtension($name);
                $fileSize = filesize($tmp_name);
                $allowed_all = array_merge(
                    $this->config['upload_allowed'],
                    $this->config['upload_images'],
                    $this->config['upload_audio']
                );

                if (! in_array($ext, $allowed_all)) {
                    $error = $this->lang['file_type_is_not_allowed'];
                    continue;
                }
                // Check file size
                if ($fileSize > $freeSpace) {
                    $error = $this->lang['file_size_exceeds_allowed_limit'];
                    continue;
                }

                $fileNameFull = $fileName.'.'.$ext;
                $uploadPath = $userDirPath.DIRECTORY_SEPARATOR.$fileNameFull;

                move_uploaded_file($tmp_name, $uploadPath);

                $properties = $this->getVideoProperties($uploadPath);

                $data = [
                    'id' => $fileName,
                    'title' => ! empty($inputTitle) ? $inputTitle : strip_tags(str_replace('.'.$ext, '', $name)),
                    'ext' => $ext,
                    'file_size' => filesize($uploadPath),
                    'time_stump' => time(),
                ];

                $data = array_merge($data, $properties);

                // Save to DB
                $fileStore = $this->dbGetStore('video_input', $user['id']);
                $fileStore->set($fileName, $data);
            }

            if ($error) {
                $output = [
                    'success' => false,
                    'msg' => $error,
                ];
            } else {
                $output = ['success' => true];
            }
        } // Import from URL
        elseif (! empty($inputUrl)) {
            $fileName = time().'_'.uniqid();
            $videoFileUrl = $inputUrl;
            $ext = 'mp4';
            $allowed_all = array_merge(
                $this->config['upload_allowed'],
                $this->config['upload_images'],
                $this->config['upload_audio']
            );

            if ($this->getYoutubeId($inputUrl)) {
                $result = $this->getUrlFromYouTube($inputUrl);

                if (false === $result) {
                    return [
                        'success' => false,
                        'msg' => $this->lang['file_type_is_not_allowed'],
                    ];
                } else {
                    if (is_array($result) && ! $result['success']) {
                        return $result;
                    }
                }
                $videoFileUrl = $result['data']['url'];
            } else {
                $ext = self::getExtension($videoFileUrl);
            }

            if (! in_array($ext, $allowed_all)) {
                return [
                    'success' => false,
                    'msg' => $this->lang['file_type_is_not_allowed'],
                ];
            }

            $fileNameFull = $fileName.'.'.$ext;
            $uploadPath = $userDirPath.DIRECTORY_SEPARATOR.$fileNameFull;

            $uploaded = file_put_contents($uploadPath, file_get_contents($videoFileUrl));

            if ($uploaded && file_exists($uploadPath)) {
                // Check file size
                $fileSize = filesize($uploadPath);
                if ($fileSize > $freeSpace) {
                    @unlink($uploadPath);

                    return [
                        'success' => false,
                        'msg' => $this->lang['file_size_exceeds_allowed_limit'],
                    ];
                }

                $properties = $this->getVideoProperties($uploadPath);

                $data = [
                    'id' => $fileName,
                    'title' => ! empty($inputTitle) ? $inputTitle : date('m/d/Y'),
                    'ext' => $ext,
                    'file_size' => filesize($uploadPath),
                    'time_stump' => time(),
                    'allowed' => true,
                ];

                $data = array_merge($data, $properties);

                // Save to DB
                $fileStore = $this->dbGetStore('video_input', $user['id']);
                $fileStore->set($fileName, $data);

                $output = ['success' => true];
            } else {
                $output = [
                    'success' => false,
                    'msg' => $this->lang['error_while_downloading_video'],
                ];
            }
        }

        return $output;
    }

    /**
     * @return array
     */
    public function getMediaList($type, $userId = 0) {
        $user = $this->getUser(false, $userId);
        if (false === $user) {
            return [
                'success' => false,
                'msg' => 'Forbidden.',
            ];
        }

        $fileStore = $this->dbGetStore('video_'.$type, $user['id']);
        $data = $fileStore->getAll();

        $data = array_reverse($data);

        foreach ($data as &$item) {
            $item['datetime'] = date('m.d.Y H:i:s', $item['time_stump']);
            $item['file_size'] = self::sizeFormat($item['file_size']);
            $item['duration_time'] = ! empty($item['duration_ms'])
                ? self::secondsToTime($item['duration_ms'] / 1000)
                : 0;
            $item['url'] = $this->config['base_url'].$this->config[$type.'_dir'];
            $item['url'] .= $user['id'].DIRECTORY_SEPARATOR.$item['id'].'.'.$item['ext'];
            if (empty($item['width'])) {
                $item['width'] = 0;
            }
            if (empty($item['height'])) {
                $item['height'] = 0;
            }
        }

        return [
            'success' => true,
            'data' => ! empty($data) ? array_values($data) : [],
        ];
    }

    /**
     * @return array
     */
    public function getItemData($itemId, $type) {
        $user = $this->getUser();
        if (false === $user) {
            return [
                'success' => false,
                'msg' => 'Forbidden.',
            ];
        }

        $fileStore = $this->dbGetStore('video_'.$type, $user['id']);
        $item = $fileStore->get($itemId);

        if (empty($item)) {
            return [
                'success' => false,
                'msg' => 'Media not found.',
            ];
        }

        $item['datetime'] = date('m.d.Y H:i:s', $item['time_stump']);
        $item['file_size'] = self::sizeFormat($item['file_size']);
        $item['duration_time'] = ! empty($item['duration_ms'])
            ? self::secondsToTime($item['duration_ms'] / 1000)
            : 0;
        $item['url'] = $this->config['base_url'].$this->config[$type.'_dir'];
        $item['url'] .= $user['id'].DIRECTORY_SEPARATOR.$item['id'].'.'.$item['ext'];

        return [
            'success' => true,
            'data' => $item,
        ];
    }

    /**
     * Update item data.
     *
     * @return array
     */
    public function updateItemData($itemId, $type, $data) {
        $user = $this->getUser();
        if (false === $user) {
            return [
                'success' => false,
                'msg' => 'Forbidden.',
            ];
        }

        $fileStore = $this->dbGetStore('video_'.$type, $user['id']);
        $item = $fileStore->get($itemId);

        if (empty($item)) {
            return [
                'success' => false,
                'msg' => 'Media not found.',
            ];
        }

        $item = array_merge($item, $data);
        $fileStore->set($itemId, $item);

        return [
            'success' => true,
            'data' => $item,
        ];
    }

    /**
     * Delete item.
     *
     * @return array
     */
    public function deleteItem($itemId, $type) {
        $user = $this->getUser();
        if (false === $user) {
            return [
                'success' => false,
                'msg' => 'Forbidden.',
            ];
        }

        $output = [];
        $fileStore = $this->dbGetStore('video_'.$type, $user['id']);

        if ($item = $fileStore->get($itemId)) {
            $filePath = $this->getPublicPath($type.'_dir', $user['id']);
            $filePath .= DIRECTORY_SEPARATOR.$item['id'].'.'.$item['ext'];

            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $fileStore->delete($item['id']);
            $output['success'] = true;
        }

        return $output;
    }

    /**
     * @return array|bool
     */
    public function toggleItemStatusAdmin($itemId, $type, $userId) {
        $user = $this->getUser();
        if (false === $user || 'admin' !== $user['role']) {
            return [
                'success' => false,
                'msg' => 'Forbidden.',
            ];
        }

        $fileStore = $this->dbGetStore('video_'.$type, $userId);
        if ($item = $fileStore->get($itemId)) {
            if (! isset($item['allowed'])) {
                $item['allowed'] = true;
            } else {
                $item['allowed'] = ! $item['allowed'];
            }
            $fileStore->set($itemId, $item);

            return true;
        }

        return false;
    }

    /**
     * Download media.
     *
     * @return array|bool
     */
    public function downloadMediaFile($itemId, $type) {
        $user = $this->getUser();
        if (false === $user) {
            echo 'Forbidden';
            exit;
        }

        $fileStore = $this->dbGetStore('video_'.$type, $user['id']);
        if ($item = $fileStore->get($itemId)) {
            if ('user' == $user['role'] && empty($item['allowed'])) {
                $template = $this->getTemplate('download_forbidden');

                return [
                    'content' => $template,
                ];
            }

            $filePath = $this->getMediaFilePath($type, $user['id'], $item);

            if (file_exists($filePath)) {
                $this->downloadFile($filePath, $item['title'].'.'.$item['ext']);
            }
            exit;
        }

        return false;
    }

    /**
     * Print video frame.
     *
     * @param int $time
     */
    public function printFrame($itemId, $type, $time = 0) {
        $user = $this->getUser();
        if (false === $user) {
            $this->printBlankImage();
        }

        $fileStore = $this->dbGetStore('video_'.$type, $user['id']);
        $item = $fileStore->get($itemId);

        if (empty($item)) {
            $this->printBlankImage();
        }

        $videoFilePath = $this->getVideoPath($user['id'], $type, $item);
        if (! file_exists($videoFilePath)) {
            $this->printBlankImage();
        }

        $tmpPath = $this->getPublicPath('tmp_dir', $user['id']);
        if (! is_dir($tmpPath)) {
            mkdir($tmpPath);
        }

        $time = $time ? $time / 1000 : 0;
        $time = number_format($time, 2, '.', '');
        $frameImagePath = $tmpPath.DIRECTORY_SEPARATOR.'frame_'.$item['id'];
        $frameImagePath .= '_'.str_replace('.', '-', $time).'.jpg';

        if (! file_exists($frameImagePath)) {
            $cmd = $this->config['ffmpeg_path']." -i \"{$videoFilePath}\" -ss $time";
            $cmd .= ' \\'.PHP_EOL.'-vf scale=400:300:force_original_aspect_ratio=increase';
            $cmd .= ' \\'.PHP_EOL.'-frames:v 1';
            $cmd .= ' \\'.PHP_EOL."-y \"{$frameImagePath}\" 2>&1";

            shell_exec($cmd);
            if (! file_exists($frameImagePath)) {
                $this->printBlankImage();
            }
        }

        $content = file_get_contents($frameImagePath);
        header('Content-Type: image/jpeg');
        echo $content;

        exit;
    }

    /**
     * @param bool $getCategories
     *
     * @return array
     */
    public function getLibraryContentList($input, $requestData, $getCategories = true) {
        $options = [
            'category' => isset($requestData['category']) ? urldecode($requestData['category']) : '',
            'page' => isset($requestData['page']) ? (int) trim($requestData['page']) : 1,
        ];
        $output = [
            'categories' => [],
            'items' => [],
            'total' => 0,
        ];
        $numberPerPage = 10;

        if (! in_array($input, ['audio_library'])) {
            return $output;
        }
        $libraryDir = 'userfiles/'.$input;
        $path = $this->config['public_path'].$libraryDir;
        $files = scandir($path);

        if ($getCategories || ! $options['category']) {
            foreach ($files as $file) {
                if (in_array($file, ['.', '..']) || ! is_dir($path.DIRECTORY_SEPARATOR.$file)) {
                    continue;
                }
                $output['categories'][] = $file;
            }
            asort($output['categories']);
            if (! $options['category'] && ! empty($output['categories'])) {
                $options['category'] = $output['categories'][0];
            }
        }
        unset($files);

        if (! $options['category']) {
            return $output;
        }

        $categoryDir = $libraryDir.DIRECTORY_SEPARATOR.$options['category'];
        $categoryDirPath = $this->config['public_path'].DIRECTORY_SEPARATOR.$categoryDir;
        $files = scandir($categoryDirPath);

        foreach ($files as $file) {
            if (\in_array($file, ['.', '..'], true)) {
                continue;
            }
            $filePath = $categoryDirPath.DIRECTORY_SEPARATOR.$file;
            $fileInfo = pathinfo($filePath);
            $output['items'][] = [
                'category' => $options['category'],
                'fileName' => $file,
                'url' => $this->config['base_url'].$categoryDir.DIRECTORY_SEPARATOR.$file,
                'title' => $fileInfo['filename'],
                'ext' => $fileInfo['extension'],
                'file_size' => self::sizeFormat(filesize($filePath)),
            ];
        }

        $output['total'] = \count($output['items']);

        if (! empty($output['items'])) {
            usort($output['items'], function ($a, $b) {
                return strcmp($a['fileName'], $b['fileName']);
            });
        }

        $totalPages = ceil($output['total'] / $numberPerPage);
        $options['offset'] = $numberPerPage * ($options['page'] - 1);

        $output['items'] = \array_slice($output['items'], $options['offset'], $numberPerPage);

        return $output;
    }

    /**
     * Print blank image.
     */
    public function printBlankImage() {
        $im = imagecreatetruecolor(300, 250);
        $color = imagecolorallocate($im, 212, 212, 212);
        imagefilledrectangle($im, 0, 0, 300, 250, $color);
        header('Content-Type: image/jpeg');
        imagejpeg($im);
        imagedestroy($im);
        exit;
    }

    /**
     * Get video file path.
     *
     * @return string
     */
    public function getVideoPath($userId, $type, $itemData) {
        $filePath = $this->getPublicPath($type.'_dir', $userId);
        $filePath .= DIRECTORY_SEPARATOR.$itemData['id'].'.'.$itemData['ext'];

        return $filePath;
    }
}
