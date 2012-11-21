<?php

namespace Searchperience\Tests\Api\Client;

/**
 * @author Michael Klapper <michael.klapper@aoemedia.de>
 * @date 14.11.12
 * @time 15:13
 */
class DocumentRepositoryTestCase extends \Searchperience\Tests\BaseTestCase {

	/**
	 * @var \Searchperience\Api\Client\Domain\DocumentRepository
	 */
	protected $documentRepository;

	/**
	 * Initialize test environment
	 *
	 * @return void
	 */
	public function setUp() {

	}

	/**
	 * Cleanup test environment
	 *
	 * @return void
	 */
	public function tearDown() {
		$this->documentRepository = NULL;
	}

	/**
	 * @test
	 */
	public function verifyGetByForeignIdReturnsValidDomainDocument() {
		$this->documentRepository = $this->getMock('\Searchperience\Api\Client\Domain\DocumentRepository', array('getByForeignId'));
		$this->documentRepository->expects($this->once())
			->method('getByForeignId')
			->will($this->returnValue(new \Searchperience\Api\Client\Domain\Document()));

		$document = $this->documentRepository->getByForeignId(312);
		$this->assertInstanceOf('\Searchperience\Api\Client\Domain\Document', $document);
	}

	/**
	 * @test
	 * @expectedException \Searchperience\Common\Exception\InvalidArgumentException
	 */
	public function getByForeignIdThrowsInvalidArgumentExceptionOnInvalidArgument() {
		$this->documentRepository = new \Searchperience\Api\Client\Domain\DocumentRepository();
		$this->documentRepository->getByForeignId(NULL);
	}

	/**
	 * @test
	 * @expectedException \Searchperience\Common\Exception\InvalidArgumentException
	 */
	public function addThrowsInvalidArgumentExceptionOnInvalidArgument() {
		$violationList = $this->getMock('\Symfony\Component\Validator\ConstraintViolationList', array('count'), array(), '', FALSE);
		$violationList->expects($this->once())
			->method('count')
			->will($this->returnValue(1));
		$validator = $this->getMock('\Symfony\Component\Validator\Validator', array('validate'), array(), '', FALSE);
		$validator->expects($this->once())
			->method('validate')
			->will($this->returnValue($violationList));
		$this->documentRepository = new \Searchperience\Api\Client\Domain\DocumentRepository();
		$this->documentRepository->injectValidator($validator);
		$this->documentRepository->add(new \Searchperience\Api\Client\Domain\Document());
	}
}
