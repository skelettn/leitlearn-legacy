<?php
declare(strict_types=1);

namespace App\View\Cell;

use Cake\View\Cell;

class KeywordsCell extends Cell
{
    protected $Keywords;
    protected $PacketsKeywords;

    public function initialize(): void
    {
        parent::initialize();
        $this->Keywords = $this->fetchTable('Keywords');
        $this->PacketsKeywords = $this->fetchTable('PacketsKeywords');
    }

    public function display(): void
    {
        $keywords = $this->Keywords->find();

        foreach ($keywords as $keyword) {
            $keyword->bg = $this->getStyles($keyword->word, 'bg');
            $keyword->fill = $this->getStyles($keyword->word, 'fill');
            $keyword->icon = $this->getStyles($keyword->word, 'icon');
        }

        $this->set('keywords', $keywords->toArray());
    }

    public function selected(?int $packet_id = null): void
    {
        $keywords = $this->Keywords->find()->toArray();

        if (!is_null($packet_id)) {
            foreach ($keywords as $keyword) {
                if (
                    $this->PacketsKeywords
                        ->find()
                        ->where(['packet_id' => $packet_id, 'keyword_id' => $keyword['id']])
                        ->count() == 1
                ) {
                    $keyword['exist'] = 1;
                }
            }
        }

        $this->set('keywords', $keywords);
    }

    public function getStyles(string $word, string $field)
    {
        $validFields = [
            'icon',
            'bg',
            'fill',
        ];

        $categoryData = [
            'Mathematics' => [
                'icon' => 'function',
                'bg' => '#0074D9',
                'fill' => '#B3E0FF',
            ],
            'Languages' => [
                'icon' => 'translate',
                'bg' => '#2ECC40',
                'fill' => '#DFF9E2',
            ],
            'History' => [
                'icon' => 'history_edu',
                'bg' => '#FF4136',
                'fill' => '#FFC3B0',
            ],
            'Geography' => [
                'icon' => 'public',
                'bg' => '#FF851B',
                'fill' => '#FFD8B2',
            ],
            'Literature' => [
                'icon' => 'book',
                'bg' => '#B10DC9',
                'fill' => '#E8CEF7',
            ],
            'Arts' => [
                'icon' => 'palette',
                'bg' => '#FFDC00',
                'fill' => '#FFF8C6',
            ],
            'Music' => [
                'icon' => 'music_note',
                'bg' => '#FF6300',
                'fill' => '#FFD1B2',
            ],
            'Social Sciences' => [
                'icon' => 'groups',
                'bg' => '#7D3C98',
                'fill' => '#D8B4E2',
            ],
            'Programming' => [
                'icon' => 'code',
                'bg' => '#39CCCC',
                'fill' => '#B2EBF2',
            ],
            'Psychology' => [
                'icon' => 'psychology',
                'bg' => '#001F3F',
                'fill' => '#428BCA',
            ],
            'Philosophy' => [
                'icon' => 'light',
                'bg' => '#4B0082',
                'fill' => '#9678D3',
            ],
            'Economics' => [
                'icon' => 'account_balance',
                'bg' => '#FF851B',
                'fill' => '#FFD8B2',
            ],
            'Biology' => [
                'icon' => 'biotech',
                'bg' => '#39CCCC',
                'fill' => '#B2EBF2',
            ],
            'Chemistry' => [
                'icon' => 'science',
                'bg' => '#FFDC00',
                'fill' => '#FFF8C6',
            ],
            'Cooking' => [
                'icon' => 'skillet',
                'bg' => '#FF6300',
                'fill' => '#FFD1B2',
            ],
            'Health' => [
                'icon' => 'spa',
                'bg' => '#39CCCC',
                'fill' => '#B2EBF2',
            ],
            'Sports' => [
                'icon' => 'fitness_center',
                'bg' => '#001F3F',
                'fill' => '#428BCA',
            ],
            'Technology' => [
                'icon' => 'devices',
                'bg' => '#34495E',
                'fill' => '#BDC3C7',
            ],
            'Cinema' => [
                'icon' => 'movie',
                'bg' => '#B10DC9',
                'fill' => '#E8CEF7',
            ],
            'Science' => [
                'icon' => 'genetics',
                'bg' => '#8E44AD',
                'fill' => '#D8B4E2',
            ],
        ];

        if (isset($categoryData[$word]) && in_array($field, $validFields)) {
            return $categoryData[$word][$field];
        } else {
            return null;
        }
    }
}
