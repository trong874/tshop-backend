<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RepositoryCommand extends Command
{
    protected $signature = 'make:repo {name}';

    protected $description = 'Tạo mới một Repository';

    public function handle()
    {
        $name = $this->argument('name');
        $segments = explode('/', $name);

        if (count($segments) > 1) {
            $className = Str::studly(array_pop($segments));
            $folderPath = app_path('Repositories/' . implode('/', $segments));

            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true);
            }
        } else {
            $className = Str::studly($name);
            $folderPath = app_path('Repositories');
        }

        $filePath = $folderPath . '/' . $className . '.php';

        if (File::exists($filePath)) {
            $this->error("$name Đã tồn tại!");
            return;
        }

        $namespace = 'App\\Repositories\\' . implode('\\', $segments);
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

        $this->info("Repository $className đã được tạo thành công!.");
    }
}
