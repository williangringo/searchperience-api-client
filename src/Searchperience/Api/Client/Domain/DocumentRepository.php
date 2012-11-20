<?php

namespace Searchperience\Api\Client\Domain;

/**
 * @author Michael Klapper <michael.klapper@aoemedia.de>
 * @date 14.11.12
 * @time 15:13
 */
class DocumentRepository {

	/**
	 * @var \Searchperience\Api\Client\System\Storage\DocumentBackendInterface
	 */
	protected $storageBackend;

	/**
	 * Injects the storage backend.
	 *
	 * @param \Searchperience\Api\Client\System\Storage\DocumentBackendInterface $storageBackend
	 * @return void
	 */
	public function injectStorageBackend(\Searchperience\Api\Client\System\Storage\DocumentBackendInterface $storageBackend) {
		$this->storageBackend = $storageBackend;
	}

	/**
	 * Add a new Document to the index
	 *
	 * @param \Searchperience\Api\Client\Domain\Document $document
	 * @return boolean
	 */
	public function add(\Searchperience\Api\Client\Domain\Document $document) {
		$status = $this->storageBackend->post($document);
		return $status;
	}

	/**
	 * Get a Document by foreignId
	 *
	 * @param string $foreignId
	 *
	 * @throws \Searchperience\Common\Exception\InvalidArgumentException
	 * @thorws \Searchperience\Common\Exception\DocumentNotFoundException
	 * @return \Searchperience\Api\Client\Domain\Document $document
	 */
	public function getByForeignId($foreignId) {
		if (!is_string($foreignId)) {
			throw new \Searchperience\Common\Exception\InvalidArgumentException('Method "' . __METHOD__ . '" accepts only strings values as $foreignId. Input was: ' . serialize($foreignId));
		}

		$document = $this->storageBackend->getByForeignId($foreignId);
		return $document;
	}

	/**
	 * Get a Document by foreignId
	 *
	 * @param string $foreignId
	 *
	 * @throws \Searchperience\Common\Exception\InvalidArgumentException
	 * @thorws \Searchperience\Common\Exception\DocumentNotFoundException
	 * @return \Searchperience\Api\Client\Domain\Document $document
	 */
	public function deleteByForeignId($foreignId) {
		if (!is_string($foreignId)) {
			throw new \Searchperience\Common\Exception\InvalidArgumentException('Method "' . __METHOD__ . '" accepts only strings values as $foreignId. Input was: ' . serialize($foreignId));
		}

		$document = $this->storageBackend->deleteByForeignId($foreignId);
		return $document;
	}
}
