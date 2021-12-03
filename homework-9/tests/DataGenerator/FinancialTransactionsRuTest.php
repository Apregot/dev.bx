<?php

class FinancialTransactionsRuTest extends \PHPUnit\Framework\TestCase
{
	public function getValidateFailSamples(): array
	{
		return [
			'empty' => [
				[],
			],
			'filled but empty' => [
				[
					'Name' => '',
					'PersonalAcc' => '',
					'BankName' => '',
					'BIC' => '',
					'CorrespAcc' => '',
				],
			],
			'values types are invalid' => [
				[
					'Name' => false,
					'PersonalAcc' => new AppendIterator(),
					'BankName' => (object)'object',
					'BIC' => true,
					'CorrespAcc' => [
						'key' => 'value',
					],
				],
			],
			'values are too long' => [
				[
					'Name' => str_repeat('a', 161),
					'PersonalAcc' => str_repeat('a', 21),
					'BankName' => str_repeat('a', 46),
					'BIC' => str_repeat('a', 10),
					'CorrespAcc' => str_repeat('a', 21),
				],
			],
		];
	}

	public function getValidateSuccessSamples(): array
	{
		return [
			'only mandatory data' => [
				[
					'Name' => 'Name',
					'PersonalAcc' => 'PersonalAcc',
					'BankName' => 'BankName',
					'BIC' => 'BIC',
					'CorrespAcc' => 'CorrespAcc',
				],
			],
			'with non mandatory data' => [
				[
					'Name' => 'Name',
					'PersonalAcc' => 'PersonalAcc',
					'BankName' => 'BankName',
					'BIC' => 'BIC',
					'CorrespAcc' => 'CorrespAcc',
					'NonMandatory' => 'value',
				],
			],
		];
	}

	/**
	 * @dataProvider getValidateFailSamples
	 *
	 * @param array $fields
	 */
	public function testValidateFail(array $fields): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();
		$dataGenerator->setFields($fields);
		$result = $dataGenerator->validate();

		static::assertFalse($result->isSuccess());
	}

	/**
	 * @dataProvider getValidateSuccessSamples
	 *
	 * @param array $fields
	 */
	public function testThatValidateSuccess(array $fields): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();

		$dataGenerator->addFields($fields);

		$result = $dataGenerator->validate();

		static::assertTrue($result->isSuccess());
	}

	public function testGetDataWithInvalidData(): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();

		$dataGenerator->setFields([]);

		$data = $dataGenerator->getData();

		static::assertEquals('ST00012|Name=|PersonalAcc=|BankName=|BIC=|CorrespAcc=', $data);
	}

	/**
	 * @dataProvider getValidateSuccessSamples
	 *
	 * @param array $fields
	 */
	public function testGetDataWithValidData(array $fields): void
	{
		$dataGenerator = new \App\DataGenerator\FinancialTransactionsRu();

		$dataGenerator->addFields($fields);

		$data = $dataGenerator->getData();

		static::assertContains(
			$data,
			[
				'ST00012|Name=Name|PersonalAcc=PersonalAcc|BankName=BankName|BIC=BIC|CorrespAcc=CorrespAcc',
				'ST00012|Name=Name|PersonalAcc=PersonalAcc|BankName=BankName|BIC=BIC|CorrespAcc=CorrespAcc|NonMandatory=value',
			]
		);
	}
}