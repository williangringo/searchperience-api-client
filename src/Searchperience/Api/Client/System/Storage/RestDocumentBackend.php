<?php

namespace Searchperience\Api\Client\System\Storage;

use Guzzle\Http\Client;
use Searchperience\Api\Client\Domain\Document\DocumentCollection;

/**
 * @author Michael Klapper <michael.klapper@aoemedia.de>
 * @date 14.11.12
 * @time 15:17
 */
class RestDocumentBackend extends \Searchperience\Api\Client\System\Storage\AbstractRestBackend implements \Searchperience\Api\Client\System\Storage\DocumentBackendInterface {



	/**
	 * {@inheritdoc}
	 */
	public function post(\Searchperience\Api\Client\Domain\Document\Document $document) {
		try {
			/** @var $response \Guzzle\http\Message\Response */
			$response = $this->restClient->setBaseUrl($this->baseUrl)
				->post('/{customerKey}/documents', NULL, $this->buildRequestArrayFromDocument($document))
				->setAuth($this->username, $this->password)
				->send();
		} catch (\Guzzle\Http\Exception\ClientErrorResponseException $exception) {
			$this->transformStatusCodeToClientErrorResponseException($exception);
		} catch (\Guzzle\Http\Exception\ServerErrorResponseException $exception) {
			$this->transformStatusCodeToServerErrorResponseException($exception);
		} catch (\Exception $exception) {
			throw new \Searchperience\Common\Exception\RuntimeException('Unknown error occurred; Please check parent exception for more details.', 1353579269, $exception);
		}

		return $response->getStatusCode();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getByForeignId($foreignId) {
		try {
			/** @var $response \Guzzle\http\Message\Response */
			$response = $this->restClient->setBaseUrl($this->baseUrl)
				->get('/{customerKey}/documents?foreignId=' . $foreignId)
				->setAuth($this->username, $this->password)
				->send();
		} catch (\Guzzle\Http\Exception\ClientErrorResponseException $exception) {
			$this->transformStatusCodeToClientErrorResponseException($exception);
		} catch (\Guzzle\Http\Exception\ServerErrorResponseException $exception) {
			$this->transformStatusCodeToServerErrorResponseException($exception);
		} catch (\Exception $exception) {
			throw new \Searchperience\Common\Exception\RuntimeException('Unknown error occurred; Please check parent exception for more details.', 1353579279, $exception);
		}

		return $this->buildDocumentFromXml($response->xml());
	}

	/**
	 * {@inheritdoc}
	 */
	public function getById($id) {
		try {
			/** @var $response \Guzzle\http\Message\Response */
			$response = $this->restClient->setBaseUrl($this->baseUrl)
					->get('/{customerKey}/documents/' . $id)
					->setAuth($this->username, $this->password)
					->send();
		} catch (\Guzzle\Http\Exception\ClientErrorResponseException $exception) {
			$this->transformStatusCodeToClientErrorResponseException($exception);
		} catch (\Guzzle\Http\Exception\ServerErrorResponseException $exception) {
			$this->transformStatusCodeToServerErrorResponseException($exception);
		} catch (\Exception $exception) {
			throw new \Searchperience\Common\Exception\RuntimeException('Unknown error occurred; Please check parent exception for more details.', 1353579279, $exception);
		}

		return $this->buildDocumentFromXml($response->xml());
	}


	/**
	 * {@inheritdoc}
	 */
	public function getByUrl($url) {
		try {
			$url = urlencode($url);
			/** @var $response \Guzzle\http\Message\Response */
			$response = $this->restClient->setBaseUrl($this->baseUrl)
					->get('/{customerKey}/documents?url=' . $url)
					->setAuth($this->username, $this->password)
					->send();
		} catch (\Guzzle\Http\Exception\ClientErrorResponseException $exception) {
			$this->transformStatusCodeToClientErrorResponseException($exception);
		} catch (\Guzzle\Http\Exception\ServerErrorResponseException $exception) {
			$this->transformStatusCodeToServerErrorResponseException($exception);
		} catch (\Exception $exception) {
			throw new \Searchperience\Common\Exception\RuntimeException('Unknown error occurred; Please check parent exception for more details.', 1353579279, $exception);
		}

		return $this->buildDocumentFromXml($response->xml());
	}

	/**
	 * {@inheritdoc}
	 * @param int $start
	 * @param int $limit
	 * @param \Searchperience\Api\Client\Domain\Filters\FilterCollection $filtersCollection
	 * @return \Searchperience\Api\Client\Domain\Document\Document
	 * @throws \Searchperience\Common\Exception\RuntimeException
	 */
	public function getAllByFilterCollection($start, $limit, \Searchperience\Api\Client\Domain\Filters\FilterCollection $filtersCollection = null) {
		$filterUrlString = '';
		if($filtersCollection != null) {
			$filterUrlString = $filtersCollection->getFilterStringFromAll();
		}

		try {
			/** @var $response \Guzzle\http\Message\Response */
			$response = $this->restClient->setBaseUrl($this->baseUrl)
					->get('/{customerKey}/documents?start=' . $start . '&limit=' . $limit . $filterUrlString)
					->setAuth($this->username, $this->password)
					->send();
		} catch (\Guzzle\Http\Exception\ClientErrorResponseException $exception) {
			$this->transformStatusCodeToClientErrorResponseException($exception);
		} catch (\Guzzle\Http\Exception\ServerErrorResponseException $exception) {
			$this->transformStatusCodeToServerErrorResponseException($exception);
		} catch (\Exception $exception) {
			throw new \Searchperience\Common\Exception\RuntimeException('Unknown error occurred; Please check parent exception for more details.', 1353579279, $exception);
		}

		$xmlElement = $response->xml();

		return $this->buildDocumentsFromXml($xmlElement);
	}

	/**
	 * {@inheritdoc}
	 */
	public function deleteByForeignId($foreignId) {
		try {
			/** @var $response \Guzzle\http\Message\Response */
			$response = $this->restClient->setBaseUrl($this->baseUrl)
				->delete('/{customerKey}/documents?foreignId=' . $foreignId)
				->setAuth($this->username, $this->password)
				->send();
		} catch (\Guzzle\Http\Exception\ClientErrorResponseException $exception) {
			$this->transformStatusCodeToClientErrorResponseException($exception);
		} catch (\Guzzle\Http\Exception\ServerErrorResponseException $exception) {
			$this->transformStatusCodeToServerErrorResponseException($exception);
		} catch (\Exception $exception) {
			throw new \Searchperience\Common\Exception\RuntimeException('Unknown error occurred; Please check parent exception for more details.', 1353579284, $exception);
		}

		return $response->getStatusCode();
	}

	/**
	 * {@inheritdoc}
	 */
	public function deleteById($id) {
		try {
			/** @var $response \Guzzle\http\Message\Response */
			$response = $this->restClient->setBaseUrl($this->baseUrl)
					->delete('/{customerKey}/documents/' . $id)
					->setAuth($this->username, $this->password)
					->send();
		} catch (\Guzzle\Http\Exception\ClientErrorResponseException $exception) {
			$this->transformStatusCodeToClientErrorResponseException($exception);
		} catch (\Guzzle\Http\Exception\ServerErrorResponseException $exception) {
			$this->transformStatusCodeToServerErrorResponseException($exception);
		} catch (\Exception $exception) {
			throw new \Searchperience\Common\Exception\RuntimeException('Unknown error occurred; Please check parent exception for more details.', 1353579284, $exception);
		}

		return $response->getStatusCode();
	}

	/**
	 * {@inheritdoc}
	 */
	public function deleteBySource($source) {
		try {
			/** @var $response \Guzzle\http\Message\Response */
			$response = $this->restClient->setBaseUrl($this->baseUrl)
					->delete('/{customerKey}/documents?source=' . $source)
					->setAuth($this->username, $this->password)
					->send();
		} catch (\Guzzle\Http\Exception\ClientErrorResponseException $exception) {
			$this->transformStatusCodeToClientErrorResponseException($exception);
		} catch (\Guzzle\Http\Exception\ServerErrorResponseException $exception) {
			$this->transformStatusCodeToServerErrorResponseException($exception);
		} catch (\Exception $exception) {
			throw new \Searchperience\Common\Exception\RuntimeException('Unknown error occurred; Please check parent exception for more details.', 1386845400, $exception);
		}

		return $response->getStatusCode();
	}

	/**
	 * @param \SimpleXMLElement $xml
	 *
	 * @return \Searchperience\Api\Client\Domain\Document\Document
	 */
	protected function buildDocumentFromXml(\SimpleXMLElement $xml) {
		$documents = $this->buildDocumentsFromXml($xml);
		return reset($documents);
	}

	/**
	 * @param \SimpleXMLElement $xml
	 *
	 * @return \Searchperience\Api\Client\Domain\Document\Document[]
	 */
	protected function buildDocumentsFromXml(\SimpleXMLElement $xml) {
		$documentArray = new DocumentCollection();
		if ($xml->totalCount instanceof \SimpleXMLElement) {
			$documentArray->setTotalCount((integer) $xml->totalCount->__toString());
		}
		$documents=$xml->xpath('document');
		foreach($documents as $document) {
			$documentAttributeArray = (array)$document->attributes();
			$documentObject = new \Searchperience\Api\Client\Domain\Document\Document();
			$documentObject ->setId((integer)$documentAttributeArray['@attributes']['id']);
			$documentObject ->setUrl((string)$document->url);
			$documentObject ->setForeignId((string)$document->foreignId);
			$documentObject ->setSource((string)$document->source);
			$documentObject ->setBoostFactor((integer)$document->boostFactor);
			$documentObject ->setContent((string)$document->content);
			$documentObject ->setGeneralPriority((integer)$document->generalPriority);
			$documentObject ->setTemporaryPriority((integer)$document->temporaryPriority);
			$documentObject ->setMimeType((string)$document->mimeType);
			$documentObject ->setIsMarkedForProcessing((integer)$document->isMarkedForProcessing);
			$documentObject ->setIsMarkedForDeletion((integer)$document->isMarkedForDeletion);
			$documentObject ->setIsProminent((integer)$document->isProminent);
			$documentObject	->setIsRedirectTo((integer)$document->isRedirectTo);
			$documentObject	->setIsDuplicateOf((integer)$document->isDuplicateOf);
			$documentObject ->setErrorCount((integer)$document->errorCount);
			$documentObject ->setLastErrorMessage((string)$document->lastErrorMessage);
			$documentObject ->setRecrawlTimeSpan((string)$document->recrawlTimeSpan);
			$documentObject ->setInternalNoIndex((string)$document->internalNoIndex);


			if(trim($document->lastProcessingTime) != '') {
				//we assume that the restapi allways return y-m-d H:i:s in the utc format
				$lastProcessingDate = $this->dateTimeService->getDateTimeFromApiDateString($document->lastProcessingTime);
				$documentObject ->setLastProcessingDate($lastProcessingDate);
			}

			if(trim($document->lastCrawlingTime) != '') {
				//we assume that the restapi allways return y-m-d H:i:s in the utc format
				$lastCrawlingDateTime = $this->dateTimeService->getDateTimeFromApiDateString($document->lastCrawlingTime);
				$documentObject ->setLastCrawlingDateTime($lastCrawlingDateTime);
			}

			$documentObject ->setNoIndex((integer)$document->noIndex);
			$documentArray[]=$documentObject;
		}

		return $documentArray ;
	}

	/**
	 * Create an array containing only the available document property values.
	 *
	 * @param \Searchperience\Api\Client\Domain\Document\Document $document
	 * @return array
	 */
	protected function buildRequestArrayFromDocument(\Searchperience\Api\Client\Domain\Document\Document $document) {
		$valueArray = array();

		if ($document->getLastProcessingDate() instanceof \DateTime) {
			$valueArray['lastProcessing'] = $this->dateTimeService->getDateStringFromDateTime($document->getLastProcessingDate());
		}
		if (!is_null($document->getBoostFactor())) {
			$valueArray['boostFactor'] = $document->getBoostFactor();
		}
		if (!is_null($document->getIsProminent())) {
			$valueArray['isProminent'] = $document->getIsProminent();
		}
		if (!is_null($document->getIsMarkedForProcessing())) {
			$valueArray['isMarkedForProcessing'] = $document->getIsMarkedForProcessing();
		}
		if (!is_null($document->getIsMarkedForDeletion())) {
			$valueArray['isMarkedForDeletion'] = $document->getIsMarkedForDeletion();
		}
		if (!is_null($document->getNoIndex())) {
			$valueArray['noIndex'] = $document->getNoIndex();
		}
		if (!is_null($document->getForeignId())) {
			$valueArray['foreignId'] = $document->getForeignId();
		}
		if (!is_null($document->getUrl())) {
			$valueArray['url'] = $document->getUrl();
		}
		if (!is_null($document->getSource())) {
			$valueArray['source'] = $document->getSource();
		}
		if (!is_null($document->getMimeType())) {
			$valueArray['mimeType'] = $document->getMimeType();
		}
		if (!is_null($document->getContent())) {
			$valueArray['content'] = $document->getContent();
		}
		if (!is_null($document->getGeneralPriority())) {
			$valueArray['generalPriority'] = $document->getGeneralPriority();
		}
		if (!is_null($document->getTemporaryPriority())) {
			$valueArray['temporaryPriority'] = $document->getTemporaryPriority();
		}

		return $valueArray;
	}

}
