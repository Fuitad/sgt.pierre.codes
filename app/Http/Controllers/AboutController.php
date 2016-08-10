<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index() {
      define('EOL', '<br>');
      $version = app()->version();

      $packages = base_path() . '/vendor/composer/installed.json';

      if (file_exists($packages)) {
        $packages = @json_decode(file_get_contents($packages), true);

        $tmp = [];

        foreach ($packages as $package) {
          $tmp[$package['name']] = $package;
        }

        ksort($tmp);
        $packages = $tmp;
        unset($tmp);
      }

      $exTime = round(microtime(true) - LARAVEL_START, 2);

      $strOutput = $version;

      if (count($packages) > 0) {
        foreach ($packages as $packageName => $package) {
          $strOutput .= EOL . "- {$packageName}@{$package['version']}";
        }
      }

      $strOutput .= EOL . "- Generated in: {$exTime} second";

      return $strOutput;
    }
}
