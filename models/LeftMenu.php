<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "left_menu".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $parent_id
 * @property int|null $status
 *
 * @property LeftMenu $parent
 * @property LeftMenu[] $leftMenus
 */
class LeftMenu extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'left_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent_id', 'status'], 'default', 'value' => null],
            [['parent_id', 'status'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => LeftMenu::className(), 'targetAttribute' => ['parent_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[Parent]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(LeftMenu::className(), ['id' => 'parent_id']);
    }

    /**
     * Gets query for [[LeftMenus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(LeftMenu::className(), ['parent_id' => 'id']);
    }
}
