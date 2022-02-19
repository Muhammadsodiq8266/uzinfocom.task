<?php
namespace app\models;

use app\components\behaviors\CommonBehavior;
use app\modules\admin\models\Users;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use Yii;
use yii\db\BaseActiveRecord;

class BaseModel extends ActiveRecord
{

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;
    const STATUS_DELETE = 0;

    /**
     * @return array|array[]
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                // if you're using datetime instead of UNIX timestamp:
                // 'value' => new Expression('NOW()'),
            ],
            [
                'class' => CommonBehavior::className(),
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_by', 'updated_by'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => ['updated_by'],
                ],

            ],
        ];
    }

    /**
     * @param $status
     * @return string
     */
    public static function getStatus($status){
        $title = 'Deleted';
        $class = ' badge-soft-danger ';
        if ($status == 1) {
            $title = Yii::t('app', 'Active');
            $class = ' badge-soft-primary ';
        } elseif($status == 2) {
            $title = Yii::t('app', 'Inactive');
            $class = ' badge-soft-warning ';
        }
        return '<span class="badge '.$class.' font-size-12 d-block">'.$title.'</span>';
    }

    /**
     * @param null $created_at
     * @param null $created_by
     * @param null $updated_at
     * @param null $updated_by
     * @return string
     */
    public static function getCreatedUpdated($created_at = null, $created_by = null, $updated_at = null, $updated_by = null){
        $created = "";
        if ($created_by) {
            $created = Users::findOne($created_by)->username;
        }
        $updated = "";
        if ($updated_by) {
            $updated = Users::findOne($updated_by)->username;
        }
        if ($created_at) {
            $created_date = date('Y-m-d H:i', $created_at);
        } else {
            $created_date = Yii::t('app', 'Not available');
        }
        if ($updated_at) {
            $updated_date = date('Y-m-d H:i', $updated_at);
        } else {
            $updated_date = Yii::t('app', 'Not available');
        }
        return '<table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>'.Yii::t('app', 'Created By').':</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-right">
                            <h6 class="text-primary">'.$created.'</h6>
                            <h6 class="text-danger">'.$created_date.'</h6>
                        </td>
                    </tr>
                    </tbody>
                </table>
        
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>'.Yii::t('app', 'Updated By').':</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="text-right">
                            <h6 class="text-primary">'.$updated.'</h6>
                            <h6 class="text-danger">'.$updated_date.'</h6>
                        </td>
                    </tr>
                    </tbody>
                </table>';
    }
}