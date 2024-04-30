<?php
if (!function_exists('db')) {
    function db() {
        return \Illuminate\Support\Facades\DB::connection();
    }
}
if (!function_exists('adminView')) {
    function adminView($pagename, $data) {
        $html = '';
        $company = webSetting('*');
        $data['profile_image'] = !empty($company['profile_image']) ? asset('uploads/' . $company['profile_image']) : "";
        $data['profile_name'] = !empty($company['first_name']) && !empty($company['last_name']) ? $company['first_name'] . ' ' . $company['last_name'] : "";
        $html.= view(ADMINPATH . 'includes/meta_file', $data);
        $html.= view(ADMINPATH . 'includes/all_css', $data);
        $html.= view(ADMINPATH . 'includes/header', $data);
        $html.= view(ADMINPATH . 'includes/sidebar', $data);
        $html.= view(ADMINPATH . $pagename, $data);
        $html.= view(ADMINPATH . 'includes/all_js', $data);
        $html.= view(ADMINPATH . 'includes/footer', $data);
        return $html;
    }
}
if (!function_exists('frontView')) {
    function frontView($pagename, $data) {
        $html = '';
        $company = webSetting('*');
        $data['company'] = $company;
        $data['profile_image'] = !empty($company['profile_image']) ? asset('uploads/' . $company['profile_image']) : "";
        $data['profile_name'] = !empty($company['first_name']) && !empty($company['last_name']) ? $company['first_name'] . ' ' . $company['last_name'] : "";
        $html.= view('frontend/includes/meta_file', $data);
        $html.= view('frontend/includes/all_css', $data);
        $html.= view('frontend/includes/header', $data);
        $html.= view('frontend/'.$pagename, $data);
        $html.= view('frontend/includes/all_js', $data);
        $html.= view('frontend/includes/footer', $data);
        return $html;
    }
}
if (!function_exists("webSetting")) {
    function webSetting($select) {
        $company = \DB::table('tbl_websetting')->select($select)->first();
        $companyArray = json_decode(json_encode($company), true);
        return $companyArray;
    }
}
if (!function_exists('convertImageInToWebp')) {
    function convertImageInToWebp($folderPath, $uploaded_file_name, $new_webp_file) {
        $source = $folderPath . '/' . $uploaded_file_name;
        $extension = pathinfo($source, PATHINFO_EXTENSION);
        $quality = 100;
        $image = '';
        if ($extension == 'jpeg' || $extension == 'jpg') {
            $image = imagecreatefromjpeg($source);
        } else if ($extension == 'gif') {
            $image = imagecreatefromgif($source);
        } else if ($extension == 'png') {
            $image = imagecreatefrompng($source);
            imagepalettetotruecolor($image);
        } else {
            $image = $uploaded_file_name;
        }
        $destination = $folderPath . '/' . $new_webp_file;
        $webp_upload_done = imagewebp($image, $destination, $quality);
        return $webp_upload_done ? $new_webp_file : '';
    }
}
function FetchExactBrowserName() {
    $userAgent = strtolower(request()->header('User-Agent'));
    if (strpos($userAgent, "opr/") !== false) {
        return "Opera";
    } elseif (strpos($userAgent, "chrome/") !== false) {
        return "Chrome";
    } elseif (strpos($userAgent, "edg/") !== false) {
        return "Microsoft Edge";
    } elseif (strpos($userAgent, "msie") !== false || strpos($userAgent, "trident/") !== false) {
        return "Internet Explorer";
    } elseif (strpos($userAgent, "firefox/") !== false) {
        return "Firefox";
    } elseif (strpos($userAgent, "safari/") !== false && strpos($userAgent, "chrome/") === false) {
        return "Safari";
    } else {
        return "Unknown";
    }
}
function imgExtension($image_jpg_png_gif, $image_webp = null) {
    $browserName = FetchExactBrowserName();
    if ($browserName === "Chrome" && !empty($image_webp)) {
        return $image_webp;
    } elseif ($browserName === "Safari" && !empty($image_webp)) {
        return $image_webp;
    } else {
        return $image_jpg_png_gif;
    }
}
if (!function_exists("validate_slug")) {
    function validate_slug($text, string $divider = '-') {
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        $text = transliterator_transliterate('Any-Latin; Latin-ASCII', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);
        $text = strtolower($text);
        return empty($text) ? 'n-a' : $text;
    }
}
function random_alphanumeric_string($length) {
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@#$&!=+';
    return substr(str_shuffle($chars), 0, $length);
}
function testInput($input) {
    $input = trim($input);
    $input = htmlspecialchars($input, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $input = filter_var($input, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    return $input;
}