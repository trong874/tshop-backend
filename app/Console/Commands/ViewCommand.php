<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ViewCommand extends Command
{
    protected $signature = 'make:view {name}';

    protected $description = 'Tạo mới một view';

    public function handle()
    {
        $name = $this->argument('name');
        $segments = explode('/', $name);

        if (count($segments) > 1) {
            $viewName = array_pop($segments);
            $folderPath = resource_path('views/' . implode('/', $segments));

            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true);
            }
        } else {
            $viewName = $name;
            $folderPath = resource_path('views');
        }

        $filePath = $folderPath . '/' . $viewName . '.blade.php';

        if (File::exists($filePath)) {
            $this->error("$name Đã tồn tại!");
            return;
        }

        $viewContent = <<<EOT
@extends('layout.master')

@section('content')
@endsection
EOT;

        File::put($filePath, $viewContent);

        $this->info("$viewName đã được tạo thành công!.");
    }
}
