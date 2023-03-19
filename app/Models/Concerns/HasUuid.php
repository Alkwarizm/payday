<?php
namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;

/**

 * Creates uuids for connected models
 */
trait HasUuid
{
    public static function bootHasUuid(): void
    {
        static::creating(function (Model $model): void {
            $model->uuid = (string) str()->uuid();
        });
    }
}
