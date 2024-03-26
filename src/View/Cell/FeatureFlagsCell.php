<?php
namespace App\View\Cell;

use Cake\View\Cell;

class FeatureFlagsCell extends Cell
{
    public function display(string $feature_name)
    {
        $feature = $this->fetchTable('FeatureFlags')->find()->where(['name' => $feature_name])->first();

        $status = false;
        if ($feature && $feature->enabled) {
            $status = true;
        }

        $this->set('feature', $feature);
        $this->set('status', $status);
    }
}