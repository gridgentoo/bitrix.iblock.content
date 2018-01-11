<?php

/**
 * Bitrix component iblock.content (webgsite.ru)
 * Компонент для битрикс, работа с инфоблоком одностраничный вывод
 *
 * @author    Falur <ienakaev@ya.ru>
 * @link      https://github.com/falur/bitrix.com.iblock.content
 * @copyright 2018 webgsite.ru
 * @license   GNU General Public License http://www.gnu.org/licenses/gpl-2.0.html
 */

use Bitrix\Main\Loader;
use Falur\Bitrix\Iblock\Elements;
use Falur\Bitrix\Support\Component\SinglePageComponent;

class IblockContentComponent extends SinglePageComponent
{
    /**
     * @var \CDBResult|\CIBlockResult|null
     */
    protected $rsData;

    protected function modules(): array
    {
        return ['iblock'];
    }

    protected function requiredParams(): array
    {
        return [
            'IBLOCK_TYPE',
            'IBLOCK_ID',
        ];
    }

    protected function params(): array
    {
        return [
            'CACHE_TYPE' => 'A',
            'CACHE_TIME' => 3600,
            'SORT_BY_1' => 'SORT',
            'SORT_ORDER_1' => 'ASC',
            'SORT_BY_2' => 'NAME',
            'SORT_ORDER_2' => 'ASC',
            'PAGINATION_COUNT' => 10,
            'PAGINATION_TEMPLATE' => '',
            'PAGINATION_NAME' => 'Страницы',
            'ADD_CACHE_STRING' => ''
        ];
    }

    protected function getSort()
    {
        return [
            $this->param('SORT_BY_1') =>  $this->param('SORT_ORDER_1'),
            $this->param('SORT_BY_2') =>  $this->param('SORT_ORDER_2')
        ];
    }

    protected function getFilter()
    {
        return array_merge($this->param('FILTER'), ['IBLOCK_ID' => $this->param('IBLOCK_ID')]);
    }

    protected function getData(): array
    {
        $builder = (new Elements)->filter($this->getFilter())->sort($this->getSort());

        $this->rsData = $builder->getRes();

        return $builder->paginate($this->param('PAGINATION_COUNT'));
    }

    protected function getPagination(): string
    {
        return $this->rsData->GetPageNavStringEx(
            $object = null, $this->param('PAGINATION_NAME'), $this->param('PAGINATION_TEMPLATE')
        );
    }

    /**
     * @return mixed|void
     * @throws \Bitrix\Main\LoaderException
     */
    public function executeComponent()
    {
        Loader::includeModule('iblock');

        $nav      = \CDBResult::NavStringForCache($this->param('PAGINATION_COUNT'));
        $cacheId  = application()->GetCurDir() . $nav . $this->param('ADD_CACHE_STRING');

        if ($this->StartResultCache(false, $cacheId)) {
            $this->arResult['ITEMS']      = $this->getData();
            $this->arResult['PAGINATION'] = $this->getPagination();

            $this->includeComponentTemplate();
        }
    }
}
