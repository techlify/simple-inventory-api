<?php
namespace TechlifyInc\LaravelModelLogger\Models;

use Illuminate\Database\Eloquent\Model;
use TechlifyInc\LaravelModelLogger\Models\LogAction;

class LoggerGuy extends Model
{

    /**
     * 
     * @param string $object_type               What type of object is this log for
     * @param any $object_id                    ID of the object the log is being created for. 0 if there was a failure, -1 if the 
     * @param integer $action   The action that is being performed
     * @param boolean $is_successful            Whether the action was successful or not
     * @param array $object                     Object if you'd like to log the object
     * @param array $data                       Any Other Data that relates to the log
     */
    public static function log($object_type, $object_id, $action, $is_successful, $object = [], $data = [])
    {
        $log = new ActivityLog();
        $log->user_id = auth()->id();
        $log->object_type = $object_type;
        $log->object_id = $object_id;
        $log->action = $action;
        $log->is_successful = $is_successful;
        $log->object = $object;
        $log->data = $data;

        return $log->save();
    }

    /**
     * 
     * @param string $object_type    What type of object is this log for
     * @param any $object_id         ID of the object the log is being created for. 0 if there was a failure, -1 if the 
     * @param array $object          Object after it has been changed
     */
    public static function logInserted($object_type, $object_id, $object)
    {
        return LoggerGuy::log($object_type, $object_id, LogAction::CREATED, true, $object);
    }

    /**
     * @param string $object_type    What type of object is this log for
     * @param any $object_id         ID of the object the log is being created for. 0 if there was a failure, -1 if the 
     * @param array $pre_object      Object before the object has been changed
     * @param array $post_object     Object after it has been changed
     */
    public static function logUpdated($object_type, $object_id, $object)
    {
        return LoggerGuy::log($object_type, $object_id, LogAction::UPDATED, true, $object);
    }

    /**
     * @param string $object_type    What type of object is this log for
     * @param any $object_id         ID of the object the log is being created for. 0 if there was a failure, -1 if the 
     * @param array $object      Object before the object has been changed
     */
    public static function logViewed($object_type, $object_id, $object, $data = [])
    {
        return LoggerGuy::log($object_type, $object_id, LogAction::VIEWED, true, $object, [], $data);
    }

    /**
     * @param string $object_type    What type of object is this log for
     * @param any $object_id         ID of the object the log is being created for. 0 if there was a failure, -1 if the 
     * @param array $object      Object before the object has been changed
     */
    public static function logDeleted($object_type, $object_id, $object)
    {
        return LoggerGuy::log($object_type, $object_id, LogAction::DELETED, true, $object);
    }
}
