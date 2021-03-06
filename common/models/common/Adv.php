<?php

namespace addons\TinyShop\common\models\common;

use common\behaviors\MerchantBehavior;
use common\helpers\StringHelper;

/**
 * This is the model class for table "{{%addon_shop_base_adv}}".
 *
 * @property int $id 序号
 * @property string $title 标题
 * @property string $cover 图片
 * @property string $location 广告位
 * @property string $silder_text 图片描述
 * @property int $start_time 开始时间
 * @property int $end_time 结束时间
 * @property string $jump_link 跳转链接
 * @property int $jump_type 跳转方式[1:新标签; 2:当前页]
 * @property int $sort 优先级
 * @property int $status 状态
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 */
class Adv extends \common\models\base\BaseModel
{
    use MerchantBehavior;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%addon_shop_base_adv}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'cover', 'start_time', 'end_time'], 'required'],
            [['merchant_id', 'is_title_show', 'sort', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'location', 'jump_type'], 'string', 'max' => 30],
            [['cover'], 'string', 'max' => 100],
            [['silder_text', 'jump_link'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'is_title_show' => '是否显示标题',
            'cover' => '封面',
            'location' => '广告位',
            'silder_text' => '图片描述',
            'start_time' => '开始时间',
            'end_time' => '结束时间',
            'jump_link' => '跳转链接',
            'jump_type' => '跳转类型',
            'sort' => '排序',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $this->start_time = StringHelper::dateToInt($this->start_time);
        $this->end_time = StringHelper::dateToInt($this->end_time);

        return parent::beforeSave($insert);
    }
}
