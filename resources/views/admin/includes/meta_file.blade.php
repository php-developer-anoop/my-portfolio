
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="<?=isset($favicon)?$favicon:''?>">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{$title}}</title>
  