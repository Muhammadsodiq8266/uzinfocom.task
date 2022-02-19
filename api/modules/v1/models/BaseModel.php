<?php

namespace app\api\modules\v1\models;

use app\models\LeftMenu;
use Yii;

class BaseModel extends LeftMenu
{
    /**
     * @return array
     */
    public static function getTreeMenu(): array
    {
        $items = self::find()
            ->where(['parent_id' => null])
            ->with([
                'children' => function ($e) {
                    $e->from(['ch' => 'left_menu'])->select([
                        'ch.name',
                        'ch.parent_id',
                        'ch.icon',
                        'ch.url'
                    ]);
                }
            ])
            ->andWhere(['status' => self::STATUS_ACTIVE])
            ->orderBy(['id' => SORT_ASC])
            ->asArray()
            ->all();
        $newItems = [];
        $i = 0;
        if (!empty($items)) {
            foreach ($items as $item) {
                if (Yii::$app->user->can($item['name'])) {
                    $newItems[$i] = $item;
                    $newItems[$i]['children'] = [];
                    if (!empty($item['children'])) {
                        foreach ($item['children'] as $child) {
                            if (Yii::$app->user->can($child['name'])) {
                                $newItems[$i]['children'][] = $child;
                            }
                        }
                    }
                    $i++;
                }
            }
        }
        return $newItems;
    }

}