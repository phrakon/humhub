<?php
/* @var $model \humhub\modules\notification\models\forms\NotificationSettings */
/* @var $form yii\widgets\ActiveForm */

use yii\bootstrap\Html
?>

<?php if($showSpaces) : ?>
    <?= humhub\modules\space\widgets\SpacePickerField::widget([
        'form' => $form,
        'model' => $model,
        'attribute' => 'spaceGuids',
        'defaultResults' => $defaultSpaces,
        'maxSelection' => 10
    ])?>
<?php endif;?>
<div class="help-block" style="margin-bottom: 0px;">
 <?= Yii::t('NotificationModule.widgets_views_notificationSettingsForm', 'You can enable outgoing notifications for a given category by choosing the disired notification targets.'); ?>
</div>
<div class="grid-view table-responsive">
    <table class="table table-middle table-hover">
        <thead>
            <tr>
                <th><?= Yii::t('NotificationModule.widgets_views_notificationSettingsForm', 'Category') ?></th>
                <th><?= Yii::t('NotificationModule.widgets_views_notificationSettingsForm', 'Description') ?></th>
                <?php foreach ($model->targets() as $target): ?>
                    <th class="text-center">
                        <?= $target->getTitle(); ?>
                    </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($model->categories() as $category): ?>
                <tr>
                    <td>
                        <strong><?= $category->getTitle() ?></strong>
                    </td>
                    <td>
                        <?= $category->getDescription() ?>
                    </td>

                    <?php foreach ($model->targets() as $target): ?>
                        <td class="text-center">
                            <?php $disabled = !$target->isEditable($model->user) || $category->isFixedSetting($target) ?>
                            <?= Html::checkbox($model->getSettingFormname($category, $target), $target->isCategoryEnabled($category, $model->user), ['style' => 'margin:0px;', 'disabled' => $disabled]) ?>
                        </td>
                    <?php endforeach; ?>

                    </div>
                <?php endforeach; ?>
        </tbody>
    </table>
</div>

