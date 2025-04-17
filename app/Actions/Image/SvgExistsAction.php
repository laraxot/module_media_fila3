<?php

declare(strict_types=1);

namespace Modules\Media\Actions\Image;

use Illuminate\Support\Arr;
use Modules\UI\Actions\Icon\GetAllIconsAction;

/**
 * Verifica l'esistenza di un SVG registrato utilizzando BladeUI Icons.
 *
 * @method bool execute(string $svgName)
 */
class SvgExistsAction
{
    /**
     * Verifica se l'SVG esiste nei set di icone registrati.
     *
     * @param  string  $svgName  Il nome dell'SVG da verificare (es: 'heroicon-o-user')
     * @return bool True se l'SVG esiste, false altrimenti
     */
    public function execute(string $svgName): bool
    {
        if (empty($svgName)) {
            return false;
        }

        $packs = app(GetAllIconsAction::class)->execute();
        foreach ($packs as $pack) {
            $icons = $pack['icons'];
            $first = Arr::first($icons, function (string $value, int $key) use ($svgName) {
                return $svgName == $value;
            });
            if ($first != null) {
                return true;
            }
        }

        return false;
    }
}
