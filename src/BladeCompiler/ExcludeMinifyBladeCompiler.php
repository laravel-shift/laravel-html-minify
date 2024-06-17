<?php

namespace DipeshSukhia\LaravelHtmlMinify\BladeCompiler;

use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\Support\Str;

class ExcludeMinifyBladeCompiler extends BladeCompiler
{
    protected $openExcludeMinifyCount = 0;
    public const EXCLUDESTART = '<!-- EXCLUDE_MINIFY_START -->';
    public const EXCLUDEEND = '<!-- EXCLUDE_MINIFY_END -->';

    public function compileString($value)
    {
        $result = parent::compileString($value);

        if ($this->openExcludeMinifyCount > 0) {
            throw new \Exception('Unclosed @excludeMinify directive detected.');
        }

        return $result;
    }

    public function compileExcludeMinify($expression)
    {
        $this->openExcludeMinifyCount++;
        return "<?php echo $this::EXCLUDESTART ?>";
    }

    public function compileEndExcludeMinify($expression)
    {
        if ($this->openExcludeMinifyCount == 0) {
            throw new \Exception('Unexpected @endExcludeMinify directive detected.');
        }

        $this->openExcludeMinifyCount--;
        return "<?php echo $this::EXCLUDEEND ?>";
    }
}
