<?php
namespace App\View\Cell;

use Cake\View\Cell;

class FeatureFlagsCell extends Cell
{
    protected $FeatureFlags;

    public function initialize(): void
    {
        parent::initialize();
        $this->FeatureFlags = $this->fetchTable('FeatureFlags');
    }

    public function display(string $feature_name)
    {
        $feature = $this->FeatureFlags->find()->where(['name' => $feature_name])->first();

        $status = false;
        if ($feature && $feature->enabled) {
            $status = true;
        }

        $this->set('feature', $feature);
        $this->set('status', $status);
    }
}