<?php declare(strict_types=1);

/**
 * Test script for FFmpeg.
 *
 * @author Andycoder <http://wdevblog.net.ru/>
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

$is_windows = false !== strpos(php_uname(), 'Windows');
$ffmpeg_path = ! empty($_POST['ffmpeg_path']) && false !== strpos($_POST['ffmpeg_path'], 'ffmpeg')
    ? trim($_POST['ffmpeg_path'])
    : '';
if (! $ffmpeg_path && ! $is_windows) {
    $ffmpeg_path = trim(shell_exec('which ffmpeg'));
}

function getCodecs($ffmpeg_path = '') {
    $lines = [];
    $encoders = [];
    exec("{$ffmpeg_path} -codecs", $lines);

    foreach ($lines as $line) {
        if (preg_match('/^\s+([A-Z .]+)\s+(\w{2,})\s+(.*)$/', $line, $m)) {
            $type = trim($m[1]);
            if (false !== strpos($type, 'E')) {
                $encoder = trim($m[2]);
                if (false !== strpos($encoder, ',')) {
                    foreach (preg_split('/,/D', $encoder) as $e) {
                        $encoders[] = $e;
                    }
                } else {
                    $encoders[] = $encoder;
                }
            }
        }
    }
    sort($encoders);

    return $encoders;
}

function getPHPPath() {
    $is_windows = false !== strpos(strtolower(php_uname()), 'windows');

    if ($is_windows) {
        $output = dirname(ini_get('extension_dir')).'/php.exe';
    } else {
        $output = trim(shell_exec('which php'));
    }

    return $output;
}

$info = [];

$info['php_version'] = ['name' => 'PHP version', 'value' => PHP_VERSION];
$info['php_path'] = ['name' => 'PHP path', 'value' => getPHPPath()];
$info['web_server'] = ['name' => 'Web server', 'value' => $_SERVER['SERVER_SOFTWARE']];
$info['ffmpeg_path'] = ['name' => 'FFMPEG path', 'value' => $ffmpeg_path];
$info['ffprobe_path'] = ['name' => 'FFPROBE path', 'value' => dirname($ffmpeg_path).DIRECTORY_SEPARATOR.'ffprobe'];

$info['ffmpeg_version'] = ['name' => 'FFMPEG version', 'value' => ''];
if ($ffmpeg_path) {
    $ffmpeg_ver = shell_exec("{$ffmpeg_path} -version");
    preg_match('/.+version.+/', $ffmpeg_ver, $matches);
    if (! empty($matches)) {
        $info['ffmpeg_version']['value'] = $matches[0];
    }
    $ffprobe_chk = shell_exec("{$info['ffprobe_path']['value']} -version");
    if (! $ffprobe_chk || false === strpos($ffprobe_chk, 'ffprobe')) {
        $info['ffprobe_path']['value'] = '';
    }
}

$info['ffmpeg_codecs'] = ['name' => 'FFMPEG codecs', 'value' => []];
if ($ffmpeg_path) {
    $info['ffmpeg_codecs']['value'] = getCodecs($ffmpeg_path);
}

if (empty($info['ffmpeg_codecs']['value'])) {
    $info['ffmpeg_path']['value'] = '';
}

ksort($info);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Test server</title>
</head>
<body>

<script type="text/javascript">
    function expandCollapse(id) {
        if (document.getElementById(id).style.display == 'none') {
            document.getElementById(id).style.display = 'block';
        } else {
            document.getElementById(id).style.display = 'none';
        }
    }
</script>

<div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label>
            FFmpeg path:
            <input type="text" name="ffmpeg_path" value="<?php echo $ffmpeg_path; ?>">
        </label>
        <button type="submit">Submit</button>
    </form>
    <br>
</div>

<table cellpadding="5" cellspacing="0" border="1">
    <colgroup>
        <col width="30%"/>
        <col width="70%"/>
    </colgroup>
    <thead>
    <tr>
        <th>Property</th>
        <th>Value</th>
    </tr>
    </thead>
    <tbody>

    <?php foreach ($info as $key => $opt) { ?>

        <tr>
            <td><?php echo $opt['name']; ?>:</td>
            <td>

                <?php if (! empty($opt['value'])) { ?>

                    <?php
                    if (! is_array($opt['value'])) {
                        echo $opt['value'];
                    } else { ?>

                        <a href="#" style="display: inline-block; margin: 5px 0;"
                           onclick="expandCollapse('<?php echo $key; ?>');return false;">[Expand/Collapse]</a>
                        <div id="<?php echo $key; ?>" style="display: none;">

                            <?php foreach ($opt['value'] as $val) { ?>

                                <div><?php echo $val; ?></div>

                            <?php } ?>

                        </div>

                    <?php } ?>

                <?php } else { ?>
                    <span style="color:red;">[Not found]</span>
                <?php } ?>

            </td>
        </tr>

    <?php } ?>

    </tbody>
</table>

</body>
</html>
