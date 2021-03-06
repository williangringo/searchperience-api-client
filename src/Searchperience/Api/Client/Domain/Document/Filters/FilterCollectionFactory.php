<?php
/**
 * @author: Nikolay Diaur <nikolay.diaur@aoe.com>
 * @Date: 2/24/14
 * @Time: 6:19 PM
 */

namespace Searchperience\Api\Client\Domain\Document\Filters;

use Searchperience\Api\Client\Domain\Document\Filters;
use Searchperience\Api\Client\Domain\Document\UrlQueueItem;
use Searchperience\Api\Client\Domain\Filters\AbstractFilterCollectionFactory;
use Searchperience\Api\Client\Domain\Filters\booleans;
use Symfony\Component\Validator\Validation;

/**
 * Class FilterRepository
 * @package Searchperience\Api\Client\Domain\Document\Filters
 * @author: Nikolay Diaur <nikolay.diaur@aoe.com>
 */
class FilterCollectionFactory extends AbstractFilterCollectionFactory {

	/**
	 * @var array
	 */
	protected $allowedFilters = array(
		'boostFactor','crawl','lastProcessed','notifications','pageRank','query','source'
	);

	/**
	 * @param $filterName
	 * @return string
	 */
	protected function getFilterClassName($filterName) {
		$filterClassName = __NAMESPACE__ . '\\' . $filterName . 'Filter';
		return $filterClassName;
	}

	/**
	 * The implementation should check the passed filter arguments to allow only valid filters.
	 *
	 * @param $filters
	 * @return booleans
	 */
	protected function validateFilterArguments($filters) {
		$filterNames = array_keys($filters);
		foreach($filterNames as $filterName)  {
			if(!in_array($filterName,$this->allowedFilters)) {
				throw new \Searchperience\Common\Exception\UnexpectedValueException('Could not handle filter '.$filterName. ' for Document entity. Is this filter allowed?');
			}
		}
		return true;
	}
}