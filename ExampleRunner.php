<?hh // strict

class ExampleRunner
{
	public static function runExampleByName(string $exampleName): void
	{
		$exampleMapper = new ExampleMapper();

		if ('' === $exampleName) {
			self::printExamplesAvailable($exampleMapper);
			return;
		}

		$exampleClass = $exampleMapper->getClass($exampleName);

		$example = new $exampleClass();
		$example->run();
	}

	private static function printExamplesAvailable(ExampleMapper $mapper): void
	{
		echo "Examples available:\n";
		foreach ($mapper->getMap() as $name => $class) {
			echo "$name -> $class\n";
		}
	}
}