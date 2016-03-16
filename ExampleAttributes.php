<?hh // strict

// Example name: attributes

<<Entity, TableName('table_name')>>
class SimpleClassWithAttributes
{
	<<__Memoize>>
	public function justAMethod(?int $x): int
	{
		echo "justAMethod executing with " . var_export($x, true) . PHP_EOL;
		if (null === $x) {
			return 0;
		}

		return $x;
	}
}

class ExampleAttributes implements ExampleInterface
{
	public function __construct() {}

	public function run(): void
	{
		$reflection = new \ReflectionClass('SimpleClassWithAttributes');
		echo "Attributes in SimpleClassWithAttributes\n";
		var_dump($reflection->getAttributes());

		$a = new SimpleClassWithAttributes();

		echo "\nTrying memoize...\n";
		echo "First call {$a->justAMethod(3)}\n";
		echo "Second call {$a->justAMethod(3)}\n";
		echo "Third call {$a->justAMethod(null)}\n";
	}
}