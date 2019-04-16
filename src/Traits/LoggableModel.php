<?php
namespace TechlifyInc\LaravelModelLogger\Traits;

use Illuminate\Database\Eloquent\Model;
use ReflectionClass;
use TechlifyInc\LaravelModelLogger\Models\LoggerGuy;

/**
 * Trait that does logging for different model operations
 *
 * @author 
 * @since 
 */
trait LoggableModel
{

    protected $logCreated = true;
    protected $logUpdated = true;
    protected $logDeleted = true;

    public static function boot()
    {
        parent::boot();

        static::created(function(Model $model) {
            if (!$model->logCreated) {
                return;
            }
            $reflect = new ReflectionClass($model);
            LoggerGuy::logInserted($reflect->getShortName(), $model->id, $model);
        });

        static::updated(function(Model $model) {
            if (!$model->logUpdated) {
                return;
            }
            $reflect = new ReflectionClass($model);
            LoggerGuy::logUpdated($reflect->getShortName(), $model->id, $model);
        });

        static::deleted(function(Model $model) {
            if (!$model->logDeleted) {
                return;
            }
            $reflect = new ReflectionClass($model);
            LoggerGuy::logDeleted($reflect->getShortName(), $model->id, $model);
        });
    }
}
