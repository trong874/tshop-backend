<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ServiceCommand extends Command
{
    protected $signature = 'make:service {name}';

    protected $description = 'Tạo mới một Service';

    public function handle()
    {
        $name = $this->argument('name');
        $segments = explode('/', $name);

        if (count($segments) > 1) {
            $className = Str::studly(array_pop($segments));
            $folderPath = app_path('Services/' . implode('/', $segments));

            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true);
            }
        } else {
            $className = Str::studly($name);
            $folderPath = app_path('Services');
        }

        $filePath = $folderPath . '/' . $className . '.php';

        if (File::exists($filePath)) {
            $this->error("$name Đã tồn tại!");
            return;
        }

        $namespace = 'App\\Services\\' . implode('\\', $segments);
        $classContents = <<<EOT
<?php

namespace $namespace;

class $className
{
    public function __construct()
    {
        // Constructor của class
    }

}
EOT;

        File::put($filePath, $classContents);

        $this->info("Service $className đã được tạo thành công!.");
    }
}
