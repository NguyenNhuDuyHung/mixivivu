<?php
class Route
{
    function __construct()
    {
    }

    function handleRoute($url = '')
    {
        global $routes; // get routes
        unset($routes['default_controller']); // unset default controller to remove conflict

        $url = trim($url, '/'); // remove slash

        // handle empty url
        if (empty($url)) {
            $url = '/';
        }
        
        // handle url
        $handleUrl = $url;
        if (!empty($routes)) {
            foreach ($routes as $key => $value) {
                // check url match key
                // Cờ regex: 
                // i: không phân biệt chữ hoa/chữ thường
                // s: thay đổi dấu '.' trong regex để khớp với all ký tự
                if (preg_match('~' . $key . '~is', $url)) {
                    // replace url
                    $handleUrl = preg_replace(
                        '~' . $key . '~is',
                        $value,
                        $url
                    );
                }
            }
        }
        return $handleUrl;
    }
}