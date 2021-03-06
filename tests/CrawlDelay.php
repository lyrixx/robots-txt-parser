<?php

class CrawlDelayTest extends \PHPUnit\Framework\TestCase
{
	/**
	 * Load library
	 */
	public static function setUpBeforeClass()
	{
		require_once(realpath(__DIR__.'/../RobotsTxtParser.php'));
	}

	/**
	 * @dataProvider generateDataForTest
	 */
	public function testCrawlDelay($robotsTxtContent)
	{
		// init parser
		$parser = new RobotsTxtParser($robotsTxtContent);
		$this->assertInstanceOf('RobotsTxtParser', $parser);
		$rules = $parser->getRules();
		$this->assertArrayHasKey('ahrefsbot', $rules);
		$this->assertArrayHasKey('crawl-delay', $rules['ahrefsbot']);
		$this->assertEquals(1.5, $rules['ahrefsbot']['crawl-delay']);
	}

	/**
	 * Generate test case data
	 * @return array
	 */
	public function generateDataForTest()
	{
		return array(
			array("
				User-Agent: AhrefsBot
				Crawl-Delay: 1.5
			")
		);
	}
}
