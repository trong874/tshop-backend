<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CastCommand extends Command
{
    protected $signature = 'make:cast {name}';

    protected $description = 'Create a Casting';

    public function handle()
    {
        $name = $this->argument('name');
        $segments = explode('/', $name);

        if (count($segments) > 1) {
            $className = Str::studly(array_pop($segments));
            $folderPath = app_path('Casts/' . implode('/', $segments));

            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true);
            }
        } else {
            $className = Str::studly($name);
            $folderPath = app_path('Casts');
        }

        $filePath = $folderPath . '/' . $className . '.php';

        if (File::exists($filePath)) {
            $this->error("$name Đã tồn tại!");
            return;
        }

        $namespace = 'App\\Casts';
        $namespace .= count($segments) > 0 ? '\\' . implode('\\', $segments) : '';
        
        $classContents = <<<EOT
<?php

namespace $namespace;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
class $className implements CastsAttributes
{
    public function get(\$model, \$key, \$value, \$attributes)
    {
        return \$value;
    }
    public function set(\$model, \$key, \$value, \$attributes)
    {
        return \$value;
    }
}
EOT;

        File::put($filePath, $classContents);

        $this->info("Cast $className đã được tạo thành công!.");
    }
}
